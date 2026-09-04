<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Alterar Senha | Área Interna</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
  @include('site.partials.navbar')

  <main class="mx-auto flex min-h-[calc(100vh-10rem)] max-w-3xl flex-col gap-8 px-4 py-10 sm:px-6 lg:px-8">
    <div class="flex items-center gap-3">
      <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary/10 text-primary">
        <i class="fa-solid fa-lock text-lg"></i>
      </div>
      <div>
        <h1 class="text-2xl font-bold text-slate-900">Alterar minha senha</h1>
        <p class="text-sm text-slate-500">Gerencie a senha de acesso da sua conta.</p>
      </div>
    </div>

    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
      <div class="mb-6 flex items-center gap-4 rounded-xl bg-slate-50 p-4">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary font-bold text-white">
          {{ strtoupper(collect(preg_split('/\s+/', auth()->user()->name) ?: [])->filter()->take(2)->map(fn ($p) => mb_substr($p, 0, 1))->implode('') ?: 'U') }}
        </div>
        <div class="min-w-0">
          <p class="truncate text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</p>
          <p class="truncate text-xs text-slate-500">{{ auth()->user()->email }}</p>
          <span class="mt-1 inline-flex items-center gap-1 rounded-full border px-2 py-0.5 text-[11px] font-medium {{ auth()->user()->isAdmin() ? 'border-amber-200 bg-amber-50 text-amber-700' : 'border-sky-200 bg-sky-50 text-sky-700' }}">
            <i class="fa-solid {{ auth()->user()->isAdmin() ? 'fa-shield-halved' : 'fa-user' }} text-[10px]"></i>
            {{ auth()->user()->isAdmin() ? 'Administrador' : 'Usuário' }}
          </span>
        </div>
      </div>

      <form method="POST" action="{{ route('site.profile.password.update') }}" class="space-y-5" x-data="{ showCurrent: false, showNew: false, showConfirm: false }">
        @csrf
        @method('PUT')

        <div>
          <label for="current_password" class="mb-1.5 block text-sm font-medium text-slate-700">Senha atual</label>
          <div class="relative">
            <input
              id="current_password"
              name="current_password"
              :type="showCurrent ? 'text' : 'password'"
              required
              autocomplete="current-password"
              class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 pr-11 text-sm shadow-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 @error('current_password') border-red-400 focus:border-red-400 focus:ring-red-200 @enderror">
            <button type="button" @click="showCurrent = !showCurrent" class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-slate-400 hover:text-slate-600" aria-label="Mostrar senha">
              <i :class="showCurrent ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
            </button>
          </div>
          @error('current_password')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Nova senha</label>
          <div class="relative">
            <input
              id="password"
              name="password"
              :type="showNew ? 'text' : 'password'"
              required
              minlength="8"
              autocomplete="new-password"
              class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 pr-11 text-sm shadow-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 @error('password') border-red-400 focus:border-red-400 focus:ring-red-200 @enderror">
            <button type="button" @click="showNew = !showNew" class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-slate-400 hover:text-slate-600" aria-label="Mostrar senha">
              <i :class="showNew ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
            </button>
          </div>
          <p class="mt-1.5 text-xs text-slate-500">Mínimo de 8 caracteres.</p>
          @error('password')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-slate-700">Confirmar nova senha</label>
          <div class="relative">
            <input
              id="password_confirmation"
              name="password_confirmation"
              :type="showConfirm ? 'text' : 'password'"
              required
              minlength="8"
              autocomplete="new-password"
              class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 pr-11 text-sm shadow-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20">
            <button type="button" @click="showConfirm = !showConfirm" class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-slate-400 hover:text-slate-600" aria-label="Mostrar senha">
              <i :class="showConfirm ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
            </button>
          </div>
        </div>

        <div class="flex flex-col-reverse items-stretch justify-end gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:items-center">
          <a href="{{ route('site.index') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
            <i class="fa-solid fa-arrow-left mr-2 text-xs"></i>
            Voltar para home
          </a>
          <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary/30">
            <i class="fa-solid fa-key mr-2 text-xs"></i>
            Salvar nova senha
          </button>
        </div>
      </form>
    </section>
  </main>

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
