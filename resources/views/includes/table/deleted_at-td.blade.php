<div class="flex items-center">
    <div class="h-2.5 w-2.5 rounded-full {{ $deleted_at !== null ? 'bg-red-500' : 'bg-green-500' }} mr-2">
    </div> {{ $deleted_at === null ? 'active' : 'inactive' }}
</div>
