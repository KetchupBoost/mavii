@extends('layouts.site')

@section('content')
<div class="py-5 page profile">
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        @include('shared.sidebar_user')
      </div>
      <div class="col-sm-9">
        @include('shared.flash_messages')

        <form method="POST" action="{{ route('users.update_profile') }}" class="card" enctype="multipart/form-data">
          <div class="card-body">
            @csrf
            
            <legend class="mb-4 text-center">{{ $title }}</legend>

            @include('shared.errors')

            <input type="hidden" name="current_subspecialties" value="{{ collect($user_subspecialties)->implode(',') }}">

            <div class="pb-5 text-center">
              <label for="avatar">
                <span id="avatarPic" class="profile__avatar" style="background: url('{{ !@$user->avatar ? asset('public/img/avatar.png') : Storage::url($user->avatar) }}'); background-size: contain;">
              </label>

              <input type="file" name="avatar" id="avatar" class="d-none">
            </div>

            <div class="form-group">
              <input type="text" name="display_name" value="{{ old('display_name') ? old('display_name') : @$user->display_name }}" class="form-control" placeholder="Nome de exibição" required>
            </div>

            <div class="form-group">
              <textarea name="bio" class="form-control" rows="4" placeholder="Fale mais sobre você" required>{{ old('bio') ? old('bio') : @$user->bio }}</textarea>
            </div>

            <div class="form-group">
              <select name="subspecialties[]" class="selectize" multiple>
                <option value="">Especialidades</option>
                @foreach($subspecialties as $key => $subspecialty)
                  <option value="{{ $subspecialty->id }}" {{ in_array($subspecialty->id, @$user_subspecialties) ? 'selected' : NULL }}>{{ $subspecialty->name }}</option>
                @endforeach
              </select>
            </div>

            <p class="mb-1">Disponível</p>
            <label class="form-switch">
              <input type="checkbox" name="status" value="{{ @$user->status }}" {{ $user->status == 1 ? 'checked' : NULL }} onchange="setBoolean(this, event)">
              <i></i>
            </label>

            <div class="pt-4 text-right">
              <input class="btn btn-dark px-5" type="submit" value="Salvar">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      // Show file name in input on select
      $(document).on('change', '[name="avatar"]', function(e) {
        var files = event.target.files,
            image = files[0],
            reader = new FileReader();

        reader.onload = function(file) {
          var avatar = document.getElementById('avatarPic');
          avatar.style.background = 'url(' + file.target.result + ') no-repeat';
        }

        reader.readAsDataURL(image);
      });
    }, false);

    function setBoolean(that, e) {
      that.value == 0 ? that.value = 1 : that.value = 0;
    }
  </script>
@endpush
