<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>{{ $orderResource->uuid }}</title>
      <style type="text/css"> * {margin:0; padding:0; text-indent:0; }
         .p, p { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 7.5pt; margin:0pt; }
         h1 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 7.5pt; }
         .s1 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 10pt; vertical-align: 27pt; }
         .s2 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 7.5pt; }
         .s3 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 7.5pt; }
         table, tbody {vertical-align: top; overflow: visible; }
      </style>
   </head>
   <body>
      <p style="padding-top: 3pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">PetShop</p>
      <h1 style="padding-top: 3pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Date: <span class="p">{{ $orderResource->created_at->format('Y-m-d') }}</span></h1>
      <h1 style="padding-left: 6pt;text-indent: 0pt;text-align: left;">Invoice #: <span class="p">{{ $orderResource->uuid }}</span></h1>
      <p style="text-indent: 0pt;text-align: left;"><br/></p>
      <p style="text-indent: 0pt;text-align: left;"><br/></p>
      <p style="padding-left: 6pt;text-indent: 0pt;text-align: left;">Customer Details:                                   Billing/Shipping Details:</p>
      <p style="text-indent: 0pt;text-align: left;"><br/></p>
      <p style="text-indent: 0pt;text-align: left;"><br/></p>
      <p style="padding-left: 12pt;text-indent: 0pt;text-align: left;">Name: {{ $user->first_name }}</p>
      <p style="padding-left: 12pt;text-indent: 0pt;text-align: left;">Last Name: {{ $user->last_name }}</p>
      <p style="padding-left: 12pt;text-indent: 0pt;text-align: left;">ID: {{ $user->uuid }}</p>
      <p style="padding-left: 12pt;text-indent: 0pt;text-align: left;">Phone Number: {{ $user->phone_number }}</p>
      <p style="padding-left: 12pt;text-indent: 0pt;text-align: left;">Email: {{ $user->email }}</p>
      <p style="padding-left: 12pt;text-indent: 0pt;line-height: 9pt;text-align: left;">Address: {{ $user->address }}</p>
      <p style="text-indent: 0pt;text-align: left;"><br/></p>
      <p style="padding-left: 12pt;text-indent: 0pt;text-align: left;">Billing: {{ $address->get('billing') }}</p>
      <p style="padding-left: 12pt;text-indent: 0pt;text-align: left;">Shipping: {{ $address->get('shipping') }}</p>
      <p style="text-indent: 0pt;text-align: left;"><br/></p>
      <p style="padding-left: 12pt;text-indent: 0pt;text-align: left;">Payment method: {{ strtoupper(implode(' ', explode('_', $paymentType) ) ) }}</p>
      
      @foreach($paymentDetails->flatten() as $details)
         <p style="padding-left: 12pt;text-indent: 0pt;text-align: left;">{{ $details }}</p>
      @endforeach

      <p style="text-indent: 0pt;text-align: left;"><br/></p>
      <p style="text-indent: 0pt;text-align: left;"><br/></p>
      <p style="padding-left: 6pt;text-indent: 0pt;text-align: left;">Items:</p>
      <p style="text-indent: 0pt;text-align: left;"><br/></p>
      <table style="border-collapse:collapse;margin-left:6.016pt" cellspacing="0">
        <thead>
            <tr style="height:18pt">
               <td style="width:24pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                  <p class="s2" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">#</p>
               </td>
               <td style="width:112pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                  <p class="s2" style="padding-top: 4pt;padding-left: 50pt;padding-right: 50pt;text-indent: 0pt;text-align: center;">ID</p>
               </td>
               <td style="width:247pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                  <p class="s2" style="padding-top: 4pt;padding-left: 104pt;padding-right: 103pt;text-indent: 0pt;text-align: center;">Item Name</p>
               </td>
               <td style="width:55pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                  <p class="s2" style="padding-top: 4pt;padding-left: 12pt;padding-right: 11pt;text-indent: 0pt;text-align: center;">Quantity</p>
               </td>
               <td style="width:44pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                  <p class="s2" style="padding-top: 4pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Unit Price</p>
               </td>
               <td style="width:45pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                  <p class="s2" style="padding-top: 4pt;padding-left: 14pt;text-indent: 0pt;text-align: left;">Price</p>
               </td>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $item)
                @php
                  $product = getProduct($item['product']);
                  $deliveryFee = $item['delivery_fee'] ?? 0;
                @endphp

                <tr style="height:27pt">
                    <td style="width:24pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                        <p style="text-indent: 0pt;text-align: left;"><br/></p>
                        <p class="s3" style="padding-left: 4pt;text-indent: 0pt;text-align: left;">1</p>
                    </td>
                    <td style="width:112pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                        <p class="s3" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">{{ $item['product'] }}</p>
                    </td>
                    <td style="width:247pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                        <p style="text-indent: 0pt;text-align: left;"><br/></p>
                        <p class="s3" style="padding-left: 4pt;text-indent: 0pt;text-align: left;">{{ $product['title'] }}</p>
                    </td>
                    <td style="width:55pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                        <p style="text-indent: 0pt;text-align: left;"><br/></p>
                        <p class="s3" style="text-indent: 0pt;text-align: center;">{{ $item['quantity'] }}</p>
                    </td>
                    <td style="width:44pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                        <p style="text-indent: 0pt;text-align: left;"><br/></p>
                        <p class="s3" style="padding-left: 4pt;text-indent: 0pt;text-align: left;">${{ $product['price'] }}</p>
                    </td>
                    <td style="width:45pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
                        <p style="text-indent: 0pt;text-align: left;"><br/></p>
                        <p class="s3" style="padding-left: 4pt;text-indent: 0pt;text-align: left;">${{ $item['quantity'] * $product['price'] }}</p>
                    </td>
                </tr>

            @endforeach
        </tbody>
      </table>

      <p style="text-indent: 0pt;text-align: left;"><br/></p>
      <p style="padding-top: 4pt;padding-left: 305pt;text-indent: 0pt;text-align: center;">Total:</p>
      <p style="text-indent: 0pt;text-align: left;"><br/></p>
      <table style="border-collapse:collapse;margin-left:306.016pt" cellspacing="0">
         <tr style="height:18pt">
            <td style="width:122pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
               <p class="s2" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">Subtotal</p>
            </td>
            <td style="width:105pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
               <p class="s3" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">$ {{ $orderResource->amount }}</p>
            </td>
         </tr>
         <tr style="height:18pt">
            <td style="width:122pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
               <p class="s2" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">Delivery fee</p>
            </td>
            <td style="width:105pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
               <p class="s3" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">$ {{ $orderResource->delivery_fee }}</p>
            </td>
         </tr>
         <tr style="height:18pt">
            <td style="width:122pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
               <p class="s2" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">TOTAL</p>
            </td>
            <td style="width:105pt;border-top-style:solid;border-top-width:1pt;border-top-color:#DDDDDD;border-left-style:solid;border-left-width:1pt;border-left-color:#DDDDDD;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#DDDDDD;border-right-style:solid;border-right-width:1pt;border-right-color:#DDDDDD">
               <p class="s2" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">$ {{ $orderResource->amount + $deliveryFee }}</p>
            </td>
         </tr>
      </table>
   </body>
</html>