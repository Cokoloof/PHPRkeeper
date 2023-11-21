<?php

namespace Tech\Rkeeper\XmlConverter\Traits;

trait OrderTrait {

    public function setOrderParamsToCreateOrderXml(Array $orderParams): string
    {
        $command = $this->generateDomObjectWithHeader();
        $command->setAttribute("CMD","CreateOrder");

        $order = $command->createElement("Order");
        //
        $comment = $orderParams["COMMENT"];
        $order->setAttribute("persistentComment", $comment);
        //
        $order = $command->appendChild($order);
        
        $orderCategory = $command->createElement("OrderCategory");
        $orderCategory->setAttribute("id", $orderParams["ORDER_CATEGORY"]);
        $orderCategory = $order->appendChild($orderCategory);

        $orderType = $command->createElement("OrderType");
        $orderType->setAttribute("id", $orderParams["ORDER_TYPE"]);
        $orderType = $order->appendChild($orderCategory);

        $table = $command->createElement("Table");
        $table->setAttribute("code",$orderParams["TABLE"]);
        $table = $order->appendChild($table);

        $guestType = $command->createElement("GuestType");
        $guestType->setAttribute("id", "1");
        $guestType = $order->appendChild($guestType);

        $guests = $command->createElement("Guests");
        $guest = $command->createElement("Guest");
        $guest->setAttribute("GuestLabel", "1");
        $guest = $guests->appendChild($guest);
        $guests = $order->appendChild($guests);
        
        return $this->saveXml($command);
    }

    public function setOrderParamsToUpdateOrderXml(Array $orderParams): string
    {
        $command = $this->generateDomObjectWithHeader();
        $command->setAttribute("CMD","SaveOrder");
        $command->setAttribute("deferred","1");

        $order = $command->createElement("Order");
        //
        $guid = $orderParams["GUID"];
        $order->setAttribute("guid", $guid);
        //
        $order = $command->appendChild($order);
        
        $session = $command->createElement("Session");
        $session = $command->appendChild($session);

        foreach($orderParams["DISHES"] as $orderDish)
        {
            $dish = $command->createElement("Dish");
            $dish->setAttribute("id",$orderDish[3]);
            $dish->setAttribute("quantity",$orderDish[1]);
            $dish = $session->appendChild($dish);
        }
        return $this->saveXml($command);
    }

    public function setOrderResultToPayOrderXml(string $xmlString): string
    {
        $command = $this->generateDomObjectWithHeader();
        $command->setAttribute("CMD","PayOrder");
      
        $order = $command->createElement("Order");
        //
        $guid = $this->getOrderGuid($xmlString);
        $order->setAttribute("guid", $guid);
        //
        $order = $command->appendChild($order);
        
        $payment = $command->createElement("Payment");
        //
        $paySum = $this->getOrderSum($xmlString);
        $payment->setAttribute("id", "1");
        $payment->setAttribute("amount", $paySum*100);
        //
        $payment = $command->appendChild($payment);
        
        return $this->saveXml($command);
    }

    public function getOrderGuid($xmlString): string
    {
        $xmlObject = $this->createDomDocumentObject();
        $xmlObject->loadXml($xmlString);
        $result = $xmlObject->getElementsByTagName("Order")[0];
        if($result != false)
            return $result->getAttribute("guid");
        else
            return "error";
    }

    public function getOrderSum($xmlString): string
    {
        $xmlObject = $this->createDomDocumentObject();
        $xmlObject->loadXml($xmlString);
        $result = $xmlObject->getElementsByTagName("Order")[0];
        if($result != false)
            return $result->getAttribute("basicSum");
        else
            return "error";
    }
}