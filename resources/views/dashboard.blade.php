<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
</x-app-layout>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}




</style>


<body>
  <!-- Add a button to trigger the modal -->
  <button id="openModalButton" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Add New Book</button>

  <!-- Modal -->
  <div id="myModal" class="modal">
      <div class="modal-content">
          <span class="close">&times;</span>
          <h3 class="text-lg font-semibold mb-4">Add a New Book</h3>
          <form id="bookForm" action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-4">
                  <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                  <input type="text" name="title" id="title" class="mt-1 p-2 border rounded-md w-full" required>
              </div>
              <div class="mb-4">
                  <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                  <input type="text" name="author" id="author" class="mt-1 p-2 border rounded-md w-full" required>
              </div>
              <div class="mb-4">
                  <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                  <textarea name="description" id="description" rows="4" class="mt-1 p-2 border rounded-md w-full" required></textarea>
              </div>
              <div class="mb-4">
                  <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                  <input type="file" name="image" id="image" class="mt-1 p-2 border rounded-md w-full">
              </div>
              <div>
                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Add Book</button>
              </div>
          </form>
      </div>
  </div>


  <script>
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementById("openModalButton");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal
  btn.onclick = function() {
      modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
      modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }



  </script>




<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-semibold mb-4">Books</h3>
                <!-- Display Books -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($books as $book)
                        <div class="border rounded-md p-4">
                            <h4 class="font-semibold">{{ $book->title }}</h4>
                            <p class="text-gray-600">{{ $book->author }}</p>
                            <p class="mt-2">{{ $book->description }}</p>
                            <img style="width:205px;" src="{{ asset('storage/images/' . $book->image) }}" alt="{{ $book->title }}" class="mt-4 rounded-md">
                            <div class="flex justify-between mt-4">
                                <!-- Edit Button -->
                                <a href="{{ route('books.edit', $book->id) }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Edit</a>
                                <!-- Delete Button -->
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
