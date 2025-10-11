# HarvestGlow Contact Form - Email Configuration Guide

## ✅ Implementation Complete

Your contact form has been successfully set up with the following features:

### Features Added:

-   ✅ Contact form with Livewire for real-time validation
-   ✅ **Flux UI components** for modern, beautiful form inputs
-   ✅ Email sending functionality via ContactMail mailable
-   ✅ Beautiful email templates with markdown
-   ✅ Form validation with error messages
-   ✅ Success/error notifications
-   ✅ **Animated loading states** on submit button (shows "Sending..." while processing)
-   ✅ Reply-to functionality (emails can be replied to directly)
-   ✅ Flux scripts properly loaded in guest layout

---

## 🔧 Hostinger Email Configuration

### Your Current Settings (Detected):

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=465
MAIL_USERNAME=info@harvestglow.org
```

### Required Settings for Hostinger (Titan Email):

**Option 1: SSL (Port 465) - Recommended**

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=465
MAIL_USERNAME=info@harvestglow.org
MAIL_PASSWORD=your-actual-email-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=info@harvestglow.org
MAIL_FROM_NAME="HarvestGlow"
```

**Option 2: TLS (Port 587) - Alternative**

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=587
MAIL_USERNAME=info@harvestglow.org
MAIL_PASSWORD=your-actual-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@harvestglow.org
MAIL_FROM_NAME="HarvestGlow"
```

---

## 🚨 Current Issue: Authentication Failed

The test shows authentication is failing because:

1. **Wrong password** - Make sure you're using the correct email account password
2. **Missing MAIL_ENCRYPTION** - Add `MAIL_ENCRYPTION=ssl` or `MAIL_ENCRYPTION=tls`
3. **Password needs reset** - You may need to reset your email password in Hostinger's hPanel

---

## 📝 How to Fix

### Step 1: Get Your Email Password from Hostinger

1. Log in to your **Hostinger hPanel**
2. Go to **Emails** → **Email Accounts**
3. Find your `info@harvestglow.org` account
4. Either:
    - Copy the existing password (if you have it saved)
    - Or click **Reset Password** to create a new one

### Step 2: Update Your `.env` File

Add or update these lines in your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=465
MAIL_USERNAME=info@harvestglow.org
MAIL_PASSWORD=YOUR_ACTUAL_PASSWORD_HERE
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=info@harvestglow.org
MAIL_FROM_NAME="HarvestGlow"
```

⚠️ **Important**: Replace `YOUR_ACTUAL_PASSWORD_HERE` with your real email password

### Step 3: Clear Configuration Cache

Run this command after updating your `.env`:

```bash
php artisan config:clear
```

### Step 4: Test Your Contact Form

1. Start your development server: `php artisan serve`
2. Visit the contact page: `http://localhost:8000/contact`
3. Fill out and submit the form
4. Check your inbox at `info@harvestglow.org`

---

## 🧪 Testing Commands

### Test Email Configuration

You can test if emails are working by running:

```bash
php artisan tinker
```

Then paste this:

```php
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

Mail::to('info@harvestglow.org')->send(new ContactMail(
    name: 'Test User',
    email: 'test@example.com',
    contactSubject: 'Test Email',
    messageContent: 'This is a test message.'
));
```

If successful, you'll see no errors and receive an email.

---

## 📧 Alternative: Hostinger Standard SMTP Settings

If `smtp.titan.email` doesn't work, try Hostinger's standard SMTP:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=info@harvestglow.org
MAIL_PASSWORD=your-actual-email-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=info@harvestglow.org
MAIL_FROM_NAME="HarvestGlow"
```

---

## 🚀 Production Deployment

### When Deploying to Hostinger:

1. Update your production `.env` file with the correct settings
2. Clear config cache: `php artisan config:clear`
3. Cache config for performance: `php artisan config:cache`
4. Ensure your email account is active in hPanel

### Security Notes:

-   ✅ Never commit your `.env` file to Git
-   ✅ Keep your email password secure
-   ✅ Use environment variables for sensitive data
-   ✅ Enable two-factor authentication on your email if available

---

## 📄 Files Modified/Created

### Created:

-   `app/Mail/ContactMail.php` - Mailable class for contact emails
-   `resources/views/emails/contact.blade.php` - Email template

### Modified:

-   `app/Livewire/Guests/Contact.php` - Added form handling logic
-   `resources/views/components/ui/contact-form.blade.php` - Converted to Livewire
-   `resources/views/livewire/guests/contact.blade.php` - Added success/error messages

---

## 🎯 How It Works

1. **User fills out the contact form** on `/contact` page
2. **Livewire validates** the form data in real-time
3. **Email is sent** to `info@harvestglow.org` via SMTP
4. **User sees success message** confirming submission
5. **You receive an email** with the contact details
6. **You can reply directly** to the sender's email

---

## 🆘 Troubleshooting

### "Authentication Failed" Error

-   ✅ Double-check your MAIL_PASSWORD in `.env`
-   ✅ Make sure MAIL_ENCRYPTION is set (ssl or tls)
-   ✅ Verify the email account exists in Hostinger hPanel
-   ✅ Try resetting your email password

### "Connection Refused" Error

-   ✅ Check your MAIL_HOST is correct
-   ✅ Try different ports (465 or 587)
-   ✅ Ensure your hosting allows SMTP connections

### Email Not Arriving

-   ✅ Check spam/junk folder
-   ✅ Verify MAIL_FROM_ADDRESS matches MAIL_USERNAME
-   ✅ Check Laravel logs: `storage/logs/laravel.log`

### Form Not Submitting

-   ✅ Check browser console for JavaScript errors
-   ✅ Ensure Livewire is properly installed
-   ✅ Clear Laravel cache: `php artisan cache:clear`

---

## 📞 Support

If you continue to experience issues:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Contact Hostinger support for SMTP settings verification
3. Ensure your hosting plan includes email functionality

---

## ✨ Next Steps

Once email is working, consider:

-   [ ] Set up email notifications for admins
-   [ ] Add auto-reply to contact form submissions
-   [ ] Implement email queues for better performance
-   [ ] Add reCAPTCHA to prevent spam submissions
