<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(session('success'))
        <div class="flex justify-center mt-5 w-full">
            <div class="bg-green-200 border-l-4 border-green-500 text-orange-dark p-4 w-1/2" role="alert">
                <p class="font-bold">Success</p>
                <p>{{session('success')}}</p>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse($comments as $comment)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-between mb-2 border-b border-gray-200">
                    <div class="p-6 bg-white">
                        <strong>{{$comment->title}}</strong> - {{Str::limit($comment->comment, 20)}}
                    </div>
                    <p class="p-5"><a href="{{route('comment.delete', $comment->id)}}">x</a></p>
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        No comment found
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
