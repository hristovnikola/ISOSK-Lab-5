<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create a New Post') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <form action="/new-post" method="post">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name="title" class="w-full border rounded py-2 px-3" />
            </div>
            <div class="mb-4">
                <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body:</label>
                <textarea name="body" class="w-full border rounded py-2 px-3" rows="6">{{ old('body') }}</textarea>
            </div>
            <div class="mb-4">
                <input type="submit" name="publish" class="bg-green-500 hover:bg-green-700 text-gray-800 font-bold py-2 px-4 rounded" value="Publish" />
{{--                <input type="submit" name="save" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded ml-2" value="Save Draft" />--}}
            </div>
        </form>
    </div>

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
        });
    </script>
</x-app-layout>
