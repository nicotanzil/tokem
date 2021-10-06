<div class="header">
  <nav>
    <div class="logo">
      <img src="/assets/logo.png" alt="Logo" class="logo">
    </div>
    <div class="content">
      <ul>
        <li><a href="#">About us</a></li>
        @if ($user && $user->role == 'admin')
        <li><a href="#">Manage Products</a></li>
        <li><a href="#">Add Category</a></li>
        
        
        @elseif($user && $user->role == 'member')
        <li><a href="#">Products</a></li>
        <li><a href="#">My Transactions</a></li>
        
        @else
        <li><a href="#">Products</a></li>
        
        @endif
      </ul>
    </div>
    <div class="account">
      @if (!$user) 
      <a href="/register"class="button sign-in">Sign in</a>
      <a href="/login" class="button sign-up">Sign up</a>

      @elseif ($user->role == 'admin')
      <div class="profile-button">
        <span class="name">{{$user->name}}</span>
        <span class="view-profile">View profile</span>
      </div>

      @elseif ($user->role == 'member')
      <a href="#" class="button cart">Cart</a>
      <div class="profile-button">
        <span class="name">{{$user->name}}</span>
        <span class="view-profile">View Profile</span>
      </div>

      @endif
    </div>
  </nav>
</div>