<div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg border">
    <div class="flex-shrink-0">
        <img src="{{ $book->cover_image_url }}" 
             alt="Cover {{ $book->title }}" 
             class="w-16 h-20 object-cover rounded border shadow-sm">
    </div>
    <div class="flex-1">
        <h4 class="text-sm font-medium text-gray-900">{{ $book->title }}</h4>
        <p class="text-xs text-gray-500">{{ $book->author }}</p>
        <p class="text-xs text-gray-400">{{ $book->category }} • {{ $book->publication_year }}</p>
    </div>
    <div class="flex-shrink-0">
        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Cover Tersedia
        </span>
    </div>
</div>
