<button @click.prevent="form.name = '{{ $network }}'" :class="{'bg-main-600 text-zinc-600': form.name === '{{ $network }}', 'bg-zinc-900 text-white': form.name !== '{{ $network }}'}" class="flex justify-center text-center border-zinc-700  p-4 rounded-lg border shadow-sm">
    <div class="flex flex-col justify-center gap-2">
        <i class="bx bxl-{{ $network }} text-3xl"></i>
        <h1 class="font-bold">{{$label}}</h1>
    </div>
</button>
