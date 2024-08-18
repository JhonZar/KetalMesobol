<?php

// app/Services/WhatsAppService.php

// app/Services/WhatsAppService.php

namespace App\Services;

use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendWhatsAppMessage($to, $message)
    {
        $from = env('TWILIO_WHATSAPP_FROM');
        $formattedFrom = strpos($from, 'whatsapp:') === 0 ? $from : "whatsapp:$from";
        $formattedTo = strpos($to, 'whatsapp:') === 0 ? $to : "whatsapp:$to";

        try {
            $response = $this->twilio->messages->create($formattedTo, [
                'from' => $formattedFrom,
                'body' => $message
            ]);

            Log::info("Mensaje enviado a $formattedTo: $message");
            return $response;
        } catch (RestException $e) {
            Log::error("Error al enviar mensaje a $formattedTo: " . $e->getMessage());
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}
