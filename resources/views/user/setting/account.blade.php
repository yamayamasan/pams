@extends('layouts.app')

@section('content')
<article class="content">
  <div class="row sameheight-container">
    <div class="card card-block sameheight-item">
      <form action="{{ $actionUrl }}" method="POST">

        {{ csrf_field() }}

        @include('components.parts.form-input-base', [
          'id' => 'name',
          'label' => 'Name',
          'placeholder' => 'Name',
          'value' => $info['name'] ?? '',
        ])
        @include('components.parts.form-input-base', [
          'id' => 'email',
          'label' => 'Email',
          'placeholder' => 'Email',
          'value' => $info['email'] ?? '',
        ])
        @include('components.parts.form-input-base', [
          'id' => 'password',
          'label' => 'Password',
          'placeholder' => 'Password',
          'value' => $info['password'] ?? '',
        ])

        <button type="submit" class="btn btn-oval btn-primary">Submit</button>

      </form>
    </div>
  </div>
</article>
@endsection
