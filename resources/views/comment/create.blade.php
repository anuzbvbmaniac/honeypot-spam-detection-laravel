<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Comment
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white lg:w-4/12 md:6/12 w-10/12 m-auto my-10 shadow-md">
                <div class="py-8 px-8 rounded-xl">
                    <h1 class="font-medium text-2xl mt-3 text-center">Comment</h1>
                    <form action="{{ route('comment.store') }}" method="POST" class="mt-6">
                        @csrf
                        <div class="my-5 text-sm">
                            <label for="title" class="block text-black">Title</label>
                            <input type="text" autofocus id="title" class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="Title" />
                        </div>
                        <div class="my-5 text-sm">
                            <label for="comment" class="block text-black">Comment</label>
                            <input type="text" id="comment" class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="Comment" />
                        </div>

                        <button class="block text-center text-white bg-gray-800 p-3 duration-300 rounded-sm hover:bg-black w-full">Comment</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
