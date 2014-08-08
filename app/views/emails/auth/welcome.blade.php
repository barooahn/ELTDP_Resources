<!DOCTYPE html>
<html lang="en-US">
    <body>
        Hi there, {{ $user->name }}. Thanks again for signing up for ELTDP! Please click <a href="http://abashed-albina.gopagoda.com/confirm?email={{$user->email}}&key={{$key}}"> here </a>' to validate your account.
 
        Thanks,
        Management
    </body>
</html>