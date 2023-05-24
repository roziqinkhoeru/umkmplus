<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" hidden value="2" name="role_id">
    <div>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="address">Address</label>
        <textarea id="address" type="text" name="address" value="{{ old('address') }}" required autofocus></textarea>
        @error('name')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="phone">Phone</label>
        <input id="phone" type="number" name="phone" value="{{ old('phone') }}" required autofocus>
        @error('name')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="dob">Date of Birth</label>
        <input id="dob" type="date" name="dob" value="{{ old('dob') }}" required autofocus>
        @error('name')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="username">Username</label>
        <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
        @error('name')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="email">Email Address</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>
