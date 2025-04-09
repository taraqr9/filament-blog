<div class="bg-white p-6 rounded-lg hover:shadow-gray-400 hover:shadow-lg transition">
    <a href="{{ route('blog.show', $blog->slug) }}">
        <img
            src="{{ $blog->thumbnail ? url('storage/'.$blog->thumbnail) : asset('images/thumbnail.jpg') }}"
            alt="Thumbnail"
            class="h-48 w-full object-cover rounded-md mb-4 shadow-gray-600 shadow-lg hover:shadow-gray-500 transition">
    </a>
    <h3 class="text-lg font-semibold">{{ Str::limit($blog->title, 40) }}</h3>
    <p class="text-gray-600">{!! Str::limit($blog->content, 90) !!}</p>
    <a href="{{ route('blog.show', $blog->slug) }}"
       class="text-blue-600 hover:underline mt-2 block">Read more</a>
</div>
