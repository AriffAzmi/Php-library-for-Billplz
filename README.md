# Simple PHP Library For Billplz And Receipt in PDF format

## Usage

Before using this library, do read the documentation at [Billplz API](https://www.billplz.com/api "Billplz API")

To use this library, you just need to initialize the Billplz class.

For example, `$bill = new Billplz();`

### You can create a bill by doing this:

`$bill = new Billplz();`

`$bill->CreateBill('customer-name','customer-email','customer-phone',$amount,'your-call-back-url','description');`

*customer-email is required if customer-phone is not present.

*customer-phone is required if customer-email is not present

#### Sample response create bill from billplz server

> {

>  "id": "W_79pJDk",

>  "collection_id": "inbmmepb",

>  "paid": false,

>  "state": "pending",

>  "amount": 200,

>  "paid_amount": 0,

>  "due_at": "2020-12-31",

>  "email": "api@billplz.com",

>  "mobile": "+60112223333",

>  "name": "MICHAEL API",

>  "metadata":

>    {

>      "id": "9999",

>      "description": "This is to test bill creation"

>    },

>  "url": "https://www.billplz.com/bills/W_79pJDk"

> }

### You can get a bill details by doing this:

`$bill = new Billplz();`

`$bill_details = $bill->GetBill("put-your-bill-id-here");`

#### sample respons bill details from billplz server 
> {

>  "id": "W_79pJDk",

>  "collection_id": "inbmmepb",

>  "paid": false,

>  "state": "pending",

>  "amount": 200,

>  "paid_amount": 0,

>  "due_at": "2020-12-31",

>  "email": "api@billplz.com",

>  "mobile": "+60112223333",

>  "name": "MICHAEL API",

>  "metadata":

>    {

>      "id": "9999",

>      "description": "This is to test bill creation"

>    },

>  "url": "http: //billplz.dev/bills/W_79pJDk"

>}

### You can delete a bill by doing this:

`$bill = new Billplz();`

`$bill->DeleteBill("your-bill-id");`
