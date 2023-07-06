@section('title', 'GNSAPK')
<div class="mt-4 container">
    <h1>@yield('title')</h1>

    {{-- @include('shared.flash') --}}
    <form action="{{ route('login')}}" method="post" class="vstack gap-3">
        @csrf
        
        {{-- @include('shared.input', ['type'=>'email','class'=>'col','name'=>'email','label'=>'Email'])
        @include('shared.input', ['type'=>'password','class'=>'col','name'=>'password','label'=>'Mot de passe'])
          --}}
        <div>
            <label for="email" class="email" >
                Email :
            </label>
            <input type="email" name="email" value="{{ old('email','john@gmail.com')}}">
                @error("email")
                {{$message}}
                @enderror  
        <div>
        </div>        
            <label for="password" class="password">
                Password :  
            </label>
            <input type="password" name="password" value="{{ old('password','5623')}}">
                @error("password")
                {{$message}}
                @enderror 
             
        </div>
        <button class="btn-primary">Se connecter</button>
        
    </form>
    
</div>


