<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PdfResource\Pages;
use App\Models\Pdf;
use App\Models\PdfFile;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Validator;

class PdfResource extends Resource
{
    protected static ?string $model = Pdf::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationGroup = 'Conteudo';

    protected static ?string $navigationLabel = 'PDFs';

    protected static ?string $modelLabel = 'PDF';

    protected static ?string $pluralModelLabel = 'PDFs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Dados do PDF')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('upload_batch')
                            ->label('Upload em lote (até 30 PDFs de uma vez)')
                            ->helperText('Selecione múltiplos arquivos — todos serão anexados ao mesmo PDF (usado para criação rápida). Você pode organizar a ordem depois no painel abaixo.')
                            ->disk('public')
                            ->directory('pdfs/files')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(20480)
                            ->multiple()
                            ->maxFiles(30)
                            ->minFiles(0)
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),

                        Forms\Components\Repeater::make('files')
                            ->label('Arquivos individuais (ordenar / editar / remover)')
                            ->helperText('Use os botões + para adicionar um arquivo por vez, ou use o Upload em Lote acima. Arraste para reordenar.')
                            ->relationship()
                            ->orderColumn('sort_order')
                            ->addActionLabel('Adicionar arquivo')
                            ->schema([
                                Forms\Components\FileUpload::make('file')
                                    ->label('Arquivo PDF')
                                    ->disk('public')
                                    ->directory('pdfs/files')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->maxSize(20480)
                                    ->downloadable()
                                    ->openable()
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->minItems(0)
                            ->maxItems(30)
                            ->itemLabel(function (array $state): string {
                                $path = $state['file'] ?? '';
                                if (is_array($path)) {
                                    $path = (string) ($path['path'] ?? $state['name'] ?? $path['file'] ?? $path[0] ?? '');
                                }
                                $path = (string) $path;
                                if ($path === '') {
                                    return 'Arquivo PDF';
                                }

                                $nome = basename($path);
                                if ($nome === '' || $nome === '.' || $nome === '/') {
                                    $nome = 'Arquivo PDF';
                                }

                                return $nome;
                            })
                            ->collapsible()
                            ->defaultItems(0)
                            ->columnSpanFull(),

                        Forms\Components\Placeholder::make('total_arquivos')
                            ->hiddenOn('create')
                            ->label('Total de arquivos cadastrados')
                            ->content(fn (Pdf $record) => (string) $record->files_count)
                            ->columnSpanFull(),
                    ]),
            ])
            ->afterStateHydrated(function (Set $set, Get $get, ?Pdf $record): void {
                $files = $get('files') ?? [];
                $upload = $get('upload_batch') ?? [];
                $set(
                    'resumo_uploads',
                    (is_countable($files) ? count($files) : 0).' arquivo(s) no painel · '
                    .(is_countable($upload) ? count($upload) : 0).' no lote pendente'
                );
            })
            ->rules([
                function (Get $get, Pdf $record): Closure {
                    return function (string $attribute, mixed $value, Closure $fail) use ($get, $record): void {
                        $arquivosRepeater = is_array($get('files')) ? count($get('files')) : 0;
                        $arquivosLote = is_array($get('upload_batch')) ? count($get('upload_batch')) : 0;

                        if ($record?->exists) {
                            $existentes = (int) PdfFile::query()
                                ->where('pdf_id', $record->getKey())
                                ->count();
                            if ($arquivosRepeater + $arquivosLote + $existentes === 0) {
                                $fail('Informe pelo menos 1 arquivo PDF (via Upload em Lote ou Adicionar arquivo).');
                            }

                            if ($arquivosRepeater + $arquivosLote + $existentes > 30) {
                                $fail('O total de arquivos (existentes + novos) não pode ultrapassar 30.');
                            }

                            return;
                        }

                        if ($arquivosRepeater + $arquivosLote === 0) {
                            $fail('Informe pelo menos 1 arquivo PDF (via Upload em Lote ou Adicionar arquivo).');
                        }

                        if ($arquivosRepeater + $arquivosLote > 30) {
                            $fail('O total de arquivos não pode ultrapassar 30.');
                        }
                    };
                },
            ])
            ->afterSave(function (Pdf $record, Set $set, Get $get): void {
                $batch = $get('upload_batch');
                if (! is_array($batch) || count($batch) === 0) {
                    return;
                }

                $ultimaOrdem = (int) PdfFile::query()
                    ->where('pdf_id', $record->getKey())
                    ->max('sort_order');

                $ordem = $ultimaOrdem;
                $jaExistem = PdfFile::query()
                    ->where('pdf_id', $record->getKey())
                    ->pluck('file')
                    ->map(static fn (mixed $f): string => is_string($f) ? trim($f) : '')
                    ->filter(static fn (string $f): bool => $f !== '')
                    ->all();

                $novos = 0;
                foreach ($batch as $caminho) {
                    if (is_array($caminho)) {
                        $caminho = (string) ($caminho['path'] ?? $caminho['file'] ?? $caminho[0] ?? '');
                    }
                    $caminho = is_string($caminho) ? trim($caminho) : '';
                    if ($caminho === '' || in_array($caminho, $jaExistem, true)) {
                        continue;
                    }
                    $ordem++;
                    PdfFile::query()->create([
                        'pdf_id'     => $record->getKey(),
                        'file'       => $caminho,
                        'sort_order' => $ordem,
                    ]);
                    $jaExistem[] = $caminho;
                    $novos++;
                }

                $set('upload_batch', []);
                if ($novos > 0) {
                    $record->load('files');
                }
            });
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->weight('semibold'),
                Tables\Columns\TextColumn::make('files_count')
                    ->label('Arquivos')
                    ->counts('files')
                    ->badge()
                    ->color(fn (string $state): string => (int) $state > 1 ? 'info' : 'primary')
                    ->formatStateUsing(fn (int $state): string => $state.' arquivo'.($state === 1 ? '' : 's')),
                Tables\Columns\TextColumn::make('file')
                    ->label('Arquivo principal')
                    ->searchable()
                    ->url(fn (Pdf $record): ?string => $record->file_url)
                    ->openUrlInNewTab()
                    ->limit(40),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPdfs::route('/'),
            'create' => Pages\CreatePdf::route('/create'),
            'edit' => Pages\EditPdf::route('/{record}/edit'),
        ];
    }
}
