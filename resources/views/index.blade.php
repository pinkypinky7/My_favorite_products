@extends('layouts.layout')

@section('index')

  <h2>　　{{$user->name}}のお気に入り商品一覧</h2>
  <button type="button" class="btn btn-primary" id="toggle">表示・編集の切替</button>
  <div>
        <table class="table table-striped" id="display">
                <tr><th>#</th><th>商品名</th><th>リンク先</th><th>JANコード</th></tr>
            @foreach($products as $product)
                <tr>
                    <td></td>
                    <td>{{ $product->name }}</td>
                    <td><a href="{{ $product->url }}" target="_blank">{{ $product->url }}</a></td>
                    <td>{{ $product->jancode }}</td>
                </tr>
            @endforeach
        </table>

        <form method="post" action= "{{url('/mypage')}}" id= "edit">
            @csrf
            <table class="table table-striped">
                <tr><th>id</th><th>商品名</th><th>リンク先</th><th>JANコード</th></tr>
            @foreach($products as $product)
                <tr>
                    <th><button type="submit" name="product_id" form="form_delete" value="{{ $product->id }}">削除</button></th>
                    <td><input type="text" name="name[]" value="{{ $product->name }}"></td>
                    <td><input type="text" name="url[]" value="{{ $product->url }}"></td>
                    <td><input type="integer" name="jancode[]" value="{{ $product->jancode }}"></td>
                    <td><input type="hidden" name="product_id[]" value={{ $product->id }}></td>
                </tr>
            @endforeach
            </table>
            <input type="submit" value="更新する">
        </form>
        <form id="form_delete"action="{{ url('/mypage_delete') }}" method="post">
        @csrf
        </form>
  </div>
{{ $products->links() }}


@endsection