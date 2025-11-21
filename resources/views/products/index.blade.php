@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Jewelry Products</h1>
  <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New</a>

  <div class="row">
    @foreach ($products as $product)
      <div class="col-md-3">
        <div class="card mb-4">
          <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
          <div class="card-body">
            <h5>{{ $product->name }}</h5>
            <p>${{ $product->price }}</p>
            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{ $products->links() }}
</div>
@endsection
