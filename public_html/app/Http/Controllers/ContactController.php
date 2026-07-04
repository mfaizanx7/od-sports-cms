<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    private function dbg(string $step, string $detail = ''): void
    {
        $line = date('Y-m-d H:i:s') . " | {$step}" . ($detail ? " | {$detail}" : '') . PHP_EOL;
        file_put_contents(storage_path('logs/mail_debug.txt'), $line, FILE_APPEND | LOCK_EX);
    }

    private function setupMailer(): array
    {
        if (!file_exists('/usr/sbin/sendmail')) {
            config([
                'mail.default'                 => 'smtp',
                'mail.from.address'            => 'm.faizanx7@gmail.com',
                'mail.from.name'               => 'OD Sports',
                'mail.mailers.smtp.transport'  => 'smtp',
                'mail.mailers.smtp.host'       => 'smtp.gmail.com',
                'mail.mailers.smtp.port'       => 587,
                'mail.mailers.smtp.encryption' => 'tls',
                'mail.mailers.smtp.username'   => 'm.faizanx7@gmail.com',
                'mail.mailers.smtp.password'   => 'qlrlnhbujwewjndp',
            ]);
            Mail::purge('smtp');
            $this->dbg('MAILER', 'WINDOWS — Gmail SMTP 587');
            return ['mailer' => 'smtp', 'from' => 'm.faizanx7@gmail.com'];
        }

        $this->dbg('MAILER', 'LINUX — native mail()');
        return ['mailer' => 'native', 'from' => 'noreply@odsports.creativeitpark.org'];
    }

    private function sendNativeMail(string $to, string $subject, string $htmlBody, string $replyTo, string $replyToName): bool
    {
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "From: OD Sports <noreply@odsports.creativeitpark.org>\r\n";
        $headers .= "Reply-To: " . $replyToName . " <" . $replyTo . ">\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        return mail($to, $subject, $htmlBody, $headers);
    }

    public function submitContact(Request $request)
    {
        $this->dbg('CONTACT', 'Controller reached');

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'org'     => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $this->dbg('CONTACT', 'Validation passed');

        $toEmail = env('MAIL_TO_ADDRESS', 'm.faizanx7@gmail.com');
        $name    = $request->input('name');
        $email   = $request->input('email');
        $org     = $request->input('org', 'N/A');
        $service = $request->input('service', 'N/A');
        $message = $request->input('message');

        $htmlBody = "
        <div style='font-family:Arial,sans-serif;max-width:600px;margin:0 auto;background:#0a0a0a;color:#fff;padding:30px;border-radius:12px;border:1px solid #333;'>
            <div style='text-align:center;margin-bottom:30px;'>
                <h1 style='color:#0056ff;font-size:1.8rem;margin:0;'>OD Sports</h1>
                <p style='color:#8ddf0d;margin:5px 0 0;font-size:0.9rem;letter-spacing:2px;text-transform:uppercase;'>New Meeting Request</p>
            </div>
            <table style='width:100%;border-collapse:collapse;'>
                <tr><td style='padding:12px 0;border-bottom:1px solid #222;color:#aaa;width:160px;'>Name</td><td style='padding:12px 0;border-bottom:1px solid #222;font-weight:600;'>".htmlspecialchars($name)."</td></tr>
                <tr><td style='padding:12px 0;border-bottom:1px solid #222;color:#aaa;'>Email</td><td style='padding:12px 0;border-bottom:1px solid #222;font-weight:600;'>".htmlspecialchars($email)."</td></tr>
                <tr><td style='padding:12px 0;border-bottom:1px solid #222;color:#aaa;'>Organization</td><td style='padding:12px 0;border-bottom:1px solid #222;'>".htmlspecialchars($org)."</td></tr>
                <tr><td style='padding:12px 0;border-bottom:1px solid #222;color:#aaa;'>Interested Service</td><td style='padding:12px 0;border-bottom:1px solid #222;'>".htmlspecialchars($service)."</td></tr>
                <tr><td style='padding:12px 0;color:#aaa;vertical-align:top;'>Message</td><td style='padding:12px 0;line-height:1.7;'>".nl2br(htmlspecialchars($message))."</td></tr>
            </table>
            <p style='margin-top:30px;font-size:0.8rem;color:#555;text-align:center;'>Submitted via OD Sports website contact form</p>
        </div>";

        ['mailer' => $mailerName, 'from' => $fromAddress] = $this->setupMailer();

        try {
            $this->dbg('CONTACT', 'Attempting send via ' . $mailerName . '...');
            if ($mailerName === 'native') {
                $sent = $this->sendNativeMail($toEmail, 'New Meeting Request from ' . $name . ' — OD Sports', $htmlBody, $email, $name);
                if (!$sent) throw new \RuntimeException('PHP mail() returned false');
            } else {
                Mail::mailer($mailerName)->html($htmlBody, function ($mail) use ($toEmail, $name, $email, $fromAddress) {
                    $mail->from($fromAddress, 'OD Sports')
                         ->to($toEmail)
                         ->replyTo($email, $name)
                         ->subject('New Meeting Request from ' . $name . ' — OD Sports');
                });
            }
            $this->dbg('CONTACT', 'SUCCESS — email sent to ' . $toEmail);
            \Illuminate\Support\Facades\Log::info('Contact form email sent to ' . $toEmail);
        } catch (\Exception $e) {
            $this->dbg('CONTACT', 'FAILED — ' . $e->getMessage() . ' | ' . $e->getFile() . ':' . $e->getLine());
            \Illuminate\Support\Facades\Log::error('Contact mail FAILED: ' . $e->getMessage());
            return redirect(route('public.index') . '#contact')->withInput()->with('mail_error', 'Mail error: ' . $e->getMessage());
        }

        return redirect(route('public.index') . '#contact')->with('contact_success', 'Thank you! We\'ll get back to you shortly.');
    }

    public function submitCustomOrder(Request $request)
    {
        $this->dbg('ORDER', 'Controller reached');

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'org'      => 'nullable|string|max:255',
            'phone'    => 'nullable|string|max:50',
            'interest' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer|min:1',
            'message'  => 'required|string',
            'file'     => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,ai,eps,svg,zip|max:10240',
        ]);

        $this->dbg('ORDER', 'Validation passed');

        $toEmail  = env('MAIL_TO_ADDRESS', 'm.faizanx7@gmail.com');
        $name     = $request->input('name');
        $email    = $request->input('email');
        $org      = $request->input('org', 'N/A');
        $phone    = $request->input('phone', 'N/A');
        $interest = $request->input('interest', 'N/A');
        $quantity = $request->input('quantity', 'N/A');
        $message  = $request->input('message');

        $htmlBody = "
        <div style='font-family:Arial,sans-serif;max-width:600px;margin:0 auto;background:#0a0a0a;color:#fff;padding:30px;border-radius:12px;border:1px solid #333;'>
            <div style='text-align:center;margin-bottom:30px;'>
                <h1 style='color:#0056ff;font-size:1.8rem;margin:0;'>OD Sports</h1>
                <p style='color:#8ddf0d;margin:5px 0 0;font-size:0.9rem;letter-spacing:2px;text-transform:uppercase;'>New Custom Order Request</p>
            </div>
            <table style='width:100%;border-collapse:collapse;'>
                <tr><td style='padding:12px 0;border-bottom:1px solid #222;color:#aaa;width:160px;'>Full Name</td><td style='padding:12px 0;border-bottom:1px solid #222;font-weight:600;'>".htmlspecialchars($name)."</td></tr>
                <tr><td style='padding:12px 0;border-bottom:1px solid #222;color:#aaa;'>Email</td><td style='padding:12px 0;border-bottom:1px solid #222;font-weight:600;'>".htmlspecialchars($email)."</td></tr>
                <tr><td style='padding:12px 0;border-bottom:1px solid #222;color:#aaa;'>Organization/Team</td><td style='padding:12px 0;border-bottom:1px solid #222;'>".htmlspecialchars($org)."</td></tr>
                <tr><td style='padding:12px 0;border-bottom:1px solid #222;color:#aaa;'>Phone</td><td style='padding:12px 0;border-bottom:1px solid #222;'>".htmlspecialchars($phone)."</td></tr>
                <tr><td style='padding:12px 0;border-bottom:1px solid #222;color:#aaa;'>Interest</td><td style='padding:12px 0;border-bottom:1px solid #222;'>".htmlspecialchars($interest)."</td></tr>
                <tr><td style='padding:12px 0;border-bottom:1px solid #222;color:#aaa;'>Est. Quantity</td><td style='padding:12px 0;border-bottom:1px solid #222;'>".htmlspecialchars($quantity)."</td></tr>
                <tr><td style='padding:12px 0;color:#aaa;vertical-align:top;'>Requirements</td><td style='padding:12px 0;line-height:1.7;'>".nl2br(htmlspecialchars($message))."</td></tr>
            </table>
            <p style='margin-top:30px;font-size:0.8rem;color:#555;text-align:center;'>Submitted via OD Sports Custom Orders page</p>
        </div>";

        ['mailer' => $mailerName, 'from' => $fromAddress] = $this->setupMailer();

        try {
            $this->dbg('ORDER', 'Attempting send via ' . $mailerName . '...');
            if ($mailerName === 'native') {
                $sent = $this->sendNativeMail($toEmail, 'New Custom Order Request from ' . $name . ' — OD Sports', $htmlBody, $email, $name);
                if (!$sent) throw new \RuntimeException('PHP mail() returned false');
            } else {
                Mail::mailer($mailerName)->html($htmlBody, function ($mail) use ($toEmail, $name, $email, $fromAddress, $request) {
                    $mail->from($fromAddress, 'OD Sports')
                         ->to($toEmail)
                         ->replyTo($email, $name)
                         ->subject('New Custom Order Request from ' . $name . ' — OD Sports');

                    if ($request->hasFile('file') && $request->file('file')->isValid()) {
                        $mail->attach(
                            $request->file('file')->getRealPath(),
                            ['as' => $request->file('file')->getClientOriginalName(), 'mime' => $request->file('file')->getMimeType()]
                        );
                    }
                });
            }
            $this->dbg('ORDER', 'SUCCESS — email sent to ' . $toEmail);
            \Illuminate\Support\Facades\Log::info('Custom order email sent to ' . $toEmail);
        } catch (\Exception $e) {
            $this->dbg('ORDER', 'FAILED — ' . $e->getMessage() . ' | ' . $e->getFile() . ':' . $e->getLine());
            \Illuminate\Support\Facades\Log::error('Custom order mail FAILED: ' . $e->getMessage());
            return redirect(route('public.custom-orders') . '#order-form')->withInput()->with('mail_error', 'Mail error: ' . $e->getMessage());
        }

        return redirect(route('public.custom-orders') . '#order-form')->with('order_success', 'Your order request has been sent! We\'ll be in touch soon.');
    }
}
