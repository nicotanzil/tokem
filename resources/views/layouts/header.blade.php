<div class="header">
  <nav>
    <div class="logo">
      <a href="/"><img src="/assets/logo.png" alt="Logo" class="logo"></a>
    </div>
    <div class="content">
      <ul>
        <li><a href="/about">About us</a></li>
        @auth
        @if (Auth::user()->role == 'admin')
        <li><a href="/products">Manage Products</a></li>
        <li><a href="/categories">Add Category</a></li>
        
        @elseif(Auth::user()->role == 'member')
        <li><a href="/products">Products</a></li>
        <li><a href="/transactions">My Transactions</a></li>
        @endif
        @endauth
        @guest
        <li><a href="/products">Products</a></li>
        
        @endguest
      </ul>
    </div>
    <div class="account">
      @if (!Auth::check()) 
        <a href="/login"class="button sign-in">Sign in</a>
        <a href="/register" class="button sign-up">Sign up</a>

      @elseif (Auth::user()->role == 'admin')
        <div class="profile-button">
          <span class="name">{{Auth::user()->name}}</span>
          <a href="/profile" class="view-profile" >
            <span class="view-profile">View profile</span>
          </a>
        </div>

      @elseif (Auth::user()->role == 'member')
        <a href="/cart" class="button cart">Cart</a>
        <div class="profile-button">
          <span class="name">{{Auth::user()->name}}</span>
          <a href="/profile" class="view-profile">
            <span class="view-profile">View profile</span>
          </a>
        </div>
      @endif
    </div>
  </nav>
</div>