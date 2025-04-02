<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
</head>
<body style="background-color: #f9f9f9; font-family: Arial, sans-serif; margin: 0; padding: 0;">

<table align="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table width="600" cellpadding="20" cellspacing="0"
                   style="background-color: #ffffff; border-radius: 8px; margin-top: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <tr>
                    <td align="center">
                        <a href="#">
                            <img src="https://via.placeholder.com/150x50" alt="Blog Logo" style="width: 150px;">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2 style="color: #333;">Hi there,</h2>
                        <p style="color: #555; line-height: 1.6;">
                            We are excited to share a brand-new blog post with you! Our latest article,
                            <strong>"{{ $blog->title }}"</strong>.
                        </p>
                        <p style="color: #555; line-height: 1.6;">
                            Stay ahead of the curve and gain insights from our expert analysis.
                        </p>
                        <p style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('blog.show', $blog->slug) }}"
                               style="background-color: #007bff; color: #ffffff; padding: 12px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
                                Read Full Blog
                            </a>
                        </p>
                        <p style="color: #555; line-height: 1.6; margin-top: 20px;">
                            Thank you for being a valued reader!
                        </p>
                        <p style="color: #333;"><strong>The Blog Team</strong></p>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="border-top: 1px solid #ddd; padding-top: 20px;">
                        <p style="color: #999; font-size: 12px;">
                            You received this email because you subscribed to our newsletter.
                            <a href="#" style="color: #007bff; text-decoration: none;">Unsubscribe</a> anytime.
                        </p>
                        <p style="color: #999; font-size: 12px;">
                            © @php echo date('Y'); @endphp Blog Website. All Rights Reserved.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
