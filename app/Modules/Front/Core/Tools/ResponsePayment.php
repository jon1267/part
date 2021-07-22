<?php

namespace App\Modules\Front\Core\Tools;

/**
 * Class WayForPay
 * @author Chenakal Serhii
 */
class ResponsePayment
{
    /** @var  string Идентификатор продавца. Данное значение присваивается Вам со стороны WayForPay */
    protected $merchantAccount;

    /** @var  string SecretKey торговца */
    protected $merchantSecretKey;

    /** @var string */
    private $orderReference;

    /** @var string */
    private $merchantSignature;

    /** @var string */
    private $amount;

    /** @var string  */
    private $currency;

    /** @var string */
    private $authCode;

    /** @var string */
    private $email;

    /** @var string */
    private $phone;

    /** @var string */
    private $createdDate;

    /** @var string */
    private $processingDate;

    /** @var string */
    private $cardPan;

    /** @var string */
    private $cardType;

    /** @var  string */
    private $issuerBankCountry;

    /** @var  string */
    private $issuerBankName;

    /** @var  string */
    private $recToken;

    /** @var  string */
    private $transactionStatus;

    /** @var  string  */
    private $reason;

    /** @var  string */
    private $reasonCode;

    /** @var  string */
    private $fee;

    /** @var  string */
    private $paymentSystem;

    /**
     * @param string $merchantAccount Идентификатор продавца. Данное значение присваивается Вам со стороны WayForPay
     * @param string $merchantSecretKey SecretKey торговца
     */
    public function __construct($merchantAccount, $merchantSecretKey)
    {
        $this->merchantAccount   = $merchantAccount;
        $this->merchantSecretKey = $merchantSecretKey;

        $data = file_get_contents('php://input');
        $data = json_decode($data, TRUE);

        if( ! empty($data)) {
            foreach ($data as $key => $value) {
                if ($data[$key]) {
                    $this->{$key} = $value;
                }
            }
        }

        if ($this->generateMerchantSignature() !== $this->getMerchantSignature()) {

            $this->orderReference = null;
        }
    }

    /**
     * @return string
     */
    public function getMerchantAccount()
    {
        return $this->merchantAccount;
    }

    /**
     * @return string
     */
    public function getOrderReference()
    {
        return $this->orderReference;
    }

    /**
     * @return string hash_hmac
     */
    public function getMerchantSignature()
    {
        return $this->merchantSignature;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * @return string email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @return string
     */
    public function getProcessingDate()
    {
        return $this->processingDate;
    }

    /**
     * @return string
     */
    public function getCardPan()
    {
        return $this->cardPan;
    }

    /**
     * @return string
     */
    public function getCardType()
    {
        return $this->cardType;
    }

    /**
     * @return string
     */
    public function getIssuerBankCountry()
    {
        return $this->issuerBankCountry;
    }

    /**
     * @return string
     */
    public function getIssuerBankName()
    {
        return $this->issuerBankName;
    }

    /**
     * @return string
     */
    public function getRecToken()
    {
        return $this->recToken;
    }

    /**
     * @return string
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return string
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * @return string
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @return string
     */
    public function getPaymentSystem()
    {
        return $this->paymentSystem;
    }

    /**
     * @return string
     */
    protected function generateMerchantSignature()
    {
        $attrForSignature = array(
            'merchantAccount',
            'orderReference',
            'amount',
            'currency',
            'authCode',
            'cardPan',
            'transactionStatus',
            'reasonCode',
        );

        $values = array();
        foreach ($attrForSignature as $attr) {
            // if (empty($this->$attr)) {
            //     continue;
            // }
            $values[] = $this->{$attr};
        }

        print_r($values);

        $string = implode(';', $values);
        $merchantSignature = hash_hmac('md5', $string, $this->merchantSecretKey);

        return $merchantSignature;
    }

    /**
     * @return string
     */
    public function generateAnswer()
    {
        $time     = time();
        $response = 'accept';
        $values   = array(
            $this->getOrderReference(),
            $response,
            $time
        );

        $string = implode(';', $values);
        $merchantSignature = hash_hmac('md5', $string, $this->merchantSecretKey);

        return json_encode(
            array(
                "orderReference" => $this->getOrderReference(),
                "status"         => $response,
                "time"           => time(),
                "signature"      => $merchantSignature

            )
        );
    }
}
