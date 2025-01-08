<!DOCTYPE html>
<html>
     <body class="font-sans antialiased">
      @php
         echo '<a href="http://clacker.test/"><h1>Home</h1></a>';
      @endphp
     	<div>
     	    <h1>For all quations please ask administrator</h1>
     	    {{$admin_contact->email}}
        </div>
     	<h1>All users</h1>
       
       	@foreach ($users as $user)

       	 <x-show-users> <div> Name:{{ $user->name}} </div> 
                        <div>contacts:{{$user->email}}</div>
         </x-show-users>
       	@endforeach
      
    </body>
</html>