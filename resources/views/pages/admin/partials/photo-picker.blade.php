{{--
    Pemilih foto: input file tersembunyi, klik / seret foto ke kartu, pratinjau langsung (JS di resources/js/app.js).
    Param: $name, $label, $hint, $current (URL foto lama|null), $shape (portrait|circle|wide),
           $required (bool), $multiple (bool: banyak foto sekaligus, pratinjau berupa grid; $name pakai "foto[]")
--}}
@php
    $current = $current ?? null;
    $shape = $shape ?? 'portrait';
    $multiple = !empty($multiple);
    $frame = ['portrait' => 'aspect-[3/4] w-32 rounded-lg', 'circle' => 'size-32 rounded-full', 'wide' => 'aspect-video w-56 rounded-lg'][$shape];
@endphp
<div data-photo-picker class="mb-6">
    <span class="mb-2 inline-block text-sm font-semibold text-admin-heading">
        {{ $label }} @if (!empty($required))<span class="font-bold text-danger-500">*</span>@endif
    </span>
    <label
        class="group flex cursor-pointer flex-col gap-4 rounded-xl border border-dashed border-admin-border bg-admin-body/60 p-4 transition-colors hover:border-admin hover:bg-admin-light/40 data-dragover:border-admin data-dragover:bg-admin-light sm:flex-row sm:items-center">
        @if ($multiple)
            <span data-photo-grid class="grid w-full shrink-0 grid-cols-4 gap-1.5 sm:w-72">
                <span class="col-span-4 grid aspect-[4/1] place-items-center rounded-lg bg-white text-admin-text ring-1 ring-admin-border">
                    <span class="material-symbols-outlined text-[28px]!" aria-hidden="true">photo_library</span>
                </span>
            </span>
        @else
            <span class="relative shrink-0 overflow-hidden bg-white ring-1 ring-admin-border {{ $frame }}">
                <img data-photo-preview @if ($current) src="{{ $current }}" @endif alt="" class="size-full object-cover {{ $current ? '' : 'hidden' }}">
                <span data-photo-empty class="absolute inset-0 grid place-items-center text-admin-text {{ $current ? 'hidden' : '' }}">
                    <span class="material-symbols-outlined text-[32px]!" aria-hidden="true">add_photo_alternate</span>
                </span>
                <span class="absolute inset-0 grid place-items-center bg-admin-ink/55 text-xs font-semibold text-white opacity-0 transition-opacity group-hover:opacity-100">
                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]!" aria-hidden="true">photo_camera</span> {{ $current ? 'Ganti' : 'Pilih' }}</span>
                </span>
            </span>
        @endif
        <span class="flex min-w-0 flex-col gap-1">
            <span class="text-sm font-semibold text-admin-heading">{{ $multiple ? 'Klik atau seret beberapa foto sekaligus' : 'Klik atau seret foto ke sini' }}</span>
            <span class="text-xs text-admin-text">{{ $hint }}</span>
            <span data-photo-name class="truncate font-mono text-[11px] text-admin"></span>
            <span class="mt-1 inline-flex w-fit items-center gap-1.5 rounded-lg border border-admin-border bg-white px-3 py-1.5 text-xs font-semibold text-admin-heading transition-colors group-hover:border-admin group-hover:text-admin">
                <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">upload</span>
                {{ $multiple ? 'Pilih foto' : ($current ? 'Ganti foto' : 'Pilih foto') }}
            </span>
        </span>
        <input type="file" name="{{ $name }}" id="{{ str_replace(['[', ']'], '', $name) }}" accept="image/*" class="sr-only"
            @if ($multiple) multiple @endif @if (!empty($required)) required @endif>
    </label>
</div>
