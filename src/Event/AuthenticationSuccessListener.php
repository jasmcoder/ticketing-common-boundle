<?php

declare(strict_types = 1);

namespace xjasmx\TicketingCommonBundle\Event;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Symfony\Component\HttpFoundation\Cookie;

class AuthenticationSuccessListener
{
    private int $jwtTokenTTL;

    private bool $cookieSecure = false;

    public function __construct(int $ttl)
    {
        $this->jwtTokenTTL = $ttl;
    }

    /**
     * @param AuthenticationSuccessEvent $event
     * @return JWTAuthenticationSuccessResponse
     * @throws \Exception
     */
    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event): JWTAuthenticationSuccessResponse
    {
        /** @var JWTAuthenticationSuccessResponse $response */
        $response = $event->getResponse();
        $data = $event->getData();
        $tokenJWT = $data['token'];
        $event->setData($data);

        $response->headers->setCookie(
            new Cookie(
                'BEARER',
                $tokenJWT,
                (new \DateTime())->add(new \DateInterval('PT' . $this->jwtTokenTTL . 'S')),
                '/',
                null,
                $this->cookieSecure
            )
        );

        return $response;
    }
}