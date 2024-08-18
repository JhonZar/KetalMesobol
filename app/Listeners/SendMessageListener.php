<?php

namespace App\Listeners;

use App\Events\SendMessageEvent;
use App\Models\Cliente;
use App\Services\WhatsAppService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendMessageListener
{
    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    public function handle(SendMessageEvent $event)
    {
        $clientes = Cliente::all();

        foreach ($clientes as $cliente) {
            // Personalizar el mensaje según el cliente
            $personalizedMessage = str_replace('{nombre}', $cliente->nombre, $event->message);

            // Formatear el número de teléfono
            $phoneNumber = $this->formatPhoneNumber($cliente->telefono);

            // Logging para depurar
            Log::info("Enviando mensaje a: $phoneNumber");

            // Enviar el mensaje
            try {
                $this->whatsAppService->sendWhatsAppMessage($phoneNumber, $personalizedMessage);
                Log::info("Mensaje enviado a: $phoneNumber");
            } catch (\Exception $e) {
                Log::error("Error al enviar mensaje a $phoneNumber: " . $e->getMessage());
            }
        }
    }

    private function formatPhoneNumber($phoneNumber)
    {
        // Añadir prefijo de WhatsApp y el código de país si no está presente
        if (strpos($phoneNumber, '+591') === false) {
            $phoneNumber = '+591' . $phoneNumber;
        }

        if (strpos($phoneNumber, 'whatsapp:') === false) {
            $phoneNumber = 'whatsapp:' . $phoneNumber;
        }

        return $phoneNumber;
    }
}
