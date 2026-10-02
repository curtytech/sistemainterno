<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PdfResource\Pages;
use App\Models\Pdf;
use App\Models\PdfFile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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

                        Forms\Components\FileUpload::make('arquivos')
                            ->label('Arquivos PDF')
                            ->helperText('Selecione um ou múltiplos PDFs (até 30 no total). Na edição, você pode adicionar novos — os já cadastrados aparecem abaixo.')
                            ->directory('pdfs/files')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(20480)
                            ->multiple()
                            ->appendFiles()
                            ->reorderable()
                            ->maxFiles(30)
                            ->minFiles(0)
                            // #region debug-point A: upload-state
                            ->afterStateUpdated(function (mixed $state): void {
                                $config = @parse_ini_file(base_path('.dbg/pdf-upload.env')) ?: [];
                                $files = is_array($state) ? array_values($state) : [$state];
                                $items = array_map(static function (mixed $file): array {
                                    $path = $file instanceof \Illuminate\Http\UploadedFile ? $file->getPathname() : null;

                                    return [
                                        'type' => get_debug_type($file),
                                        'temp_exists' => is_string($path) ? is_file($path) : null,
                                    ];
                                }, $files);

                                try {
                                    \Illuminate\Support\Facades\Http::timeout(2)->post($config['DEBUG_SERVER_URL'] ?? 'http://127.0.0.1:7777/event', [
                                        'sessionId' => $config['DEBUG_SESSION_ID'] ?? 'pdf-upload',
                                        'runId' => 'post-fix',
                                        'hypothesisId' => 'A',
                                        'location' => 'PdfResource.php:FileUpload.afterStateUpdated',
                                        'msg' => '[DEBUG] Multiple upload state received',
                                        'data' => [
                                            'state_type' => get_debug_type($state),
                                            'item_count' => count($files),
                                            'items' => $items,
                                            'default_disk' => config('filesystems.default'),
                                            'livewire_temp_disk' => config('livewire.temporary_file_upload.disk'),
                                        ],
                                    ]);
                                } catch (\Throwable) {
                                }
                            })
                            // #endregion
                            ->previewable()
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),

                        Forms\Components\Section::make('Arquivos já cadastrados')
                            ->hiddenOn('create')
                            ->collapsible()
                            ->schema([
                                Forms\Components\Repeater::make('arquivos_existentes_placeholder')
                                    ->label(false)
                                    ->dehydrated(false)
                                    ->addable(false)
                                    ->deletable(false)
                                    ->reorderable(false)
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
                                        // #region debug-point F: existing-files-hydration
                                        ->afterStateHydrated(function (mixed $state): void {
                                            $debugConfig = @parse_ini_file(base_path('.dbg/pdf-upload.env')) ?: [];

                                            try {
                                                \Illuminate\Support\Facades\Http::timeout(2)->post($debugConfig['DEBUG_SERVER_URL'] ?? 'http://127.0.0.1:7777/event', [
                                                    'sessionId' => $debugConfig['DEBUG_SESSION_ID'] ?? 'pdf-upload',
                                                    'runId' => 'post-fix',
                                                    'hypothesisId' => 'F',
                                                    'location' => 'PdfResource.php:existing-files-hydration',
                                                    'msg' => '[DEBUG] Existing files repeater hydrated',
                                                    'data' => [
                                                        'state_type' => get_debug_type($state),
                                                        'item_count' => is_array($state) ? count($state) : null,
                                                        'first_item_keys' => is_array($state) && is_array(reset($state)) ? array_keys(reset($state)) : [],
                                                    ],
                                                ]);
                                            } catch (\Throwable) {
                                            }
                                        })
                                        // #endregion
                                        ->schema([
                                        Forms\Components\FileUpload::make('file')
                                            ->label('Arquivo')
                                            ->disabled()
                                            ->directory('pdfs/files')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->downloadable()
                                            ->openable()
                                            ->previewable()
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columns(1)
                            ->columnSpanFull(),
                    ]),
            ]);
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
