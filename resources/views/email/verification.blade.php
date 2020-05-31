 <!DOCTYPE html>
 <html lang="en">
 <body>
   <p>Dear Username</p>
   <p>Your account has been created. Please click the following link to active your account</p>
 <a href="{{route('verify',$user->email_verification_token)}}">{{route('verify',$user->email_verification_token)}}</a>

   <p>Thanks</p>
 </body>
 </html>
