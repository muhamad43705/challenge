<?php 
$this->errorMsg =  array();
 

// ERROR MSG

$this->systemErrorMsg[404] = 'Page not found.';

// DB CONNECTION 
$this->errorMsg[100] = 'Connection failed.';
 
// UDPATE DATA ERROR
$this->errorMsg[200] = 'Item is not valid.';
$this->errorMsg[201] = 'Change of status failed.';
$this->errorMsg[202] = 'Data could not be changed to WAITING status.';
$this->errorMsg[203] = 'Data is not in WAITING status.';
$this->errorMsg[204] = 'Data is not in CONFIRMATION status.';
$this->errorMsg[205] = 'Data is not in FINISH status.';
$this->errorMsg[206] = 'Data is not in ACTIVE status.'; 
$this->errorMsg[207] = 'Data is not in INACTIVE status.'; 
$this->errorMsg[210] = 'Data cannot be deleted.';
$this->errorMsg[211] = 'Predefined data cannot be deleted.'; 
$this->errorMsg[212] = 'Update data failed.';

// MEMBER LOGIN, LOGOUT, PROFILE, ACTIVATION etc 
$this->errorMsg[300] = 'Log in failed. Login ID and password did not match.';
$this->errorMsg[301] = '';
$this->errorMsg[302] = 'Account was not found.';
$this->errorMsg[303] = 'Link is expired.';
$this->errorMsg[304] = '';

//STOCK
$this->errorMsg[400] = 'This warehouse has been recorded in item movement.';
$this->errorMsg[401] = 'This item has been recorded in item movement.';
$this->errorMsg[402] = 'Stock is insufficient.';

//TRANSACTION
$this->errorMsg[500] = 'Total transaction dan unit price must be bigger than 0.';
$this->errorMsg[501] = 'Transaction details cannot be empty.';
$this->errorMsg[502] = 'Payment is insufficient.';
$this->errorMsg[503] = 'Total transaction must be bigger than 0.'; 
$this->errorMsg[504] = 'GL Error.';

// ETC
$this->errorMsg[900] = 'Change of status failed due to active connection with another data.';
$this->errorMsg[901] = 'Mail delivery failed.'; 
  

// EMPTY FIELD
//general
$this->errorMsg['username'][1] = 'Username cannot be empty.';
$this->errorMsg['username'][2] = 'The username already exists. Please try another username.';
$this->errorMsg['username'][3] = 'Username must be between 5 to 30 characters long.';
$this->errorMsg['username'][4] = 'Username can only contain letters, numbers, and underscore.';
$this->errorMsg['username'][5] = 'Username and password did not match.';

$this->errorMsg['code'][1] = 'Code cannot be empty.';
$this->errorMsg['code'][2] = 'Code already exists. Please choose another code.';

$this->errorMsg['name'][1] = 'Name cannot be empty.';
$this->errorMsg['name'][2] = 'Name already exists. Please choose another username.';


// particular field
$this->errorMsg['address'][1] = 'Address cannot be empty.';

$this->errorMsg['amount'][1] = 'Amount cannot be empty.';
$this->errorMsg['amount'][2] = 'Amount must be bigger than 0.';  

$this->errorMsg['ap'][1] = 'AP cannot be empty.';
$this->errorMsg['ap'][2] = 'AP is not in OPEN status.';

$this->errorMsg['apPayment'][2] = 'AP payment must be bigger than 0.';

$this->errorMsg['ar'][1] = 'AR cannot be empty.';
$this->errorMsg['ar'][2] = 'AR is not in OPEN status.';
$this->errorMsg['ar'][3] = 'Piutang hanya dapat diubah menjadi PARTIAL melalui pembayaran piutang.';


$this->errorMsg['arPayment'][2] = 'AR payment must be bigger than 0.';

$this->errorMsg['article'][1] = 'The title of article cannot be empty.';
$this->errorMsg['article'][2] = 'The title of article already exists. Please choose another title.';

$this->errorMsg['banner'][1] = 'Banner name cannot be empty.';
$this->errorMsg['banner'][2] = 'The banner name already exists. Please choose another banner name.';
 
$this->errorMsg['bank'][1] = 'Bank name cannot be empty.';

$this->errorMsg['bankaccountname'][1] = 'Account name cannot be empty.';

$this->errorMsg['bankaccountnumber'][1] = 'Account number cannot be empty.';

$this->errorMsg['brand'][1] = 'Brand name cannot be empty.';
$this->errorMsg['brand'][2] = 'The brand name already exists. Please choose another brand name.';

$this->errorMsg['cart'][1] = 'Your cart is empty.'; 

$this->errorMsg['category'][1] = 'Category cannot be empty.';
$this->errorMsg['category'][2] = 'The category name already exists. Please choose another category.';  

$this->errorMsg['captcha'][1] = 'invalid CAPTCHA.'; 

$this->errorMsg['coa'][1] = 'Account cannot be empty.';
$this->errorMsg['coa'][2] = 'The account name already exists. Please choose another account.'; 
$this->errorMsg['coa'][3] = 'invalid account link.';

$this->errorMsg['coatransfer'][1] = 'Akun asal dan akun tujuan tidak boleh sama.';

$this->errorMsg['currency'][1] = 'Currency cannot be empty.';
$this->errorMsg['currency'][2] = 'The currency name already exists. Please choose another currency.';

$this->errorMsg['customer'][1] = 'The customer name cannot be empty.';
$this->errorMsg['customer'][2] = 'The customer name already exists. Please choose another customer name.';

$this->errorMsg['city'][1] = 'City cannot be empty .';
$this->errorMsg['city'][2] = 'The city name already exists. Please choose another city name.';
$this->errorMsg['city'][3] = 'City is not valid.';

$this->errorMsg['codeVariant'][1] = 'Variation name / alternative name cannt be empty.';
$this->errorMsg['codeVariant'][2] = 'Variation name for the same group already exists. Please choose another variation name.';
  
$this->errorMsg['date'][1] = 'Date cannot be empty.';
$this->errorMsg['date'][2] = 'Date already exists. Please choose another date.';
$this->errorMsg['date'][3] = 'Starting date must be earlier than end date.';
   
$this->errorMsg['division'][1] = 'Division name cannot be empty.';
$this->errorMsg['division'][2] = 'The division name already exists. Please choose another division name.';

$this->errorMsg['duedays'][1] = 'Due date cannot be empty.';
$this->errorMsg['duedays'][2] = 'Due date must be bigger than 0.';

$this->errorMsg['email'][1] = 'Email address cannot be empty.';
$this->errorMsg['email'][2] = 'Email address already exists. Please choose another email address.';
$this->errorMsg['email'][3] = 'Email address is not valid.';
$this->errorMsg['email'][4] = 'The email does not exist, please try another email.';

$this->errorMsg['employee'][1] = 'Staff name cannot be empty.';
$this->errorMsg['employee'][2] = 'The staff name already exists. Please choose another staff name.';

$this->errorMsg['eta'][1] = 'ETA cannot be empty.';  

$this->errorMsg['event'][1] = 'Title of event cannot be empty.';
$this->errorMsg['event'][2] = 'The title of event already exists. Please choose another title of event.';
 
$this->errorMsg['generalJournal'][1] = 'The total of the debit amounts must be equal to the total of the credit amounts.';

$this->errorMsg['gramasi'][1] = 'Weight cannot be empty.';
$this->errorMsg['gramasi'][2] = 'Weight must be bigger or the same as 0.';

$this->errorMsg['invoice'][1] = 'Invoice name cannot be empty.';

$this->errorMsg['item'][1] = 'Item name cannot be empty.';
$this->errorMsg['item'][2] = 'The item name already exists. Please choose another item name.';

$this->errorMsg['itemAdjustment'][1] = 'Item qty has been changed.'; 
    
$this->errorMsg['itemFilter'][1] = 'Item filter name cannot be empty.';

$this->errorMsg['itemUnit'][1] = 'Unit name cannot be empty.';
$this->errorMsg['itemUnit'][2] = 'The unit name already exists. Please choose another unit name.';

$this->errorMsg['itemParent'][1] = 'Item parent cannot be empty.'; 
 
$this->errorMsg['limit'][1] = 'You have reached your maximum data limit.';
$this->errorMsg['limit'][2] = 'you have reached your maximum images limit.';
$this->errorMsg['limit'][3] = 'you have reached your maximum files limit.';
$this->errorMsg['limit'][4] = 'Image size is too large.';   
$this->errorMsg['limit'][5] = 'File size is too large.';   

$this->errorMsg['login'][1] = 'Login failed. Your account is not yet activated.';
$this->errorMsg['login'][2] = 'Login failed. Your account account has been suspended.';  
$this->errorMsg['login'][3] = 'Too many failed login attempts. Please try again in {{LOCKOUT_MINUTES}} minutes.';  
 
$this->errorMsg['maxStockQty'][1] = 'Maximum stock cannot be empty.';
$this->errorMsg['maxStockQty'][2] = 'Maximum stock must be bigger or the same as 0.';

$this->errorMsg['message'][1] = 'Message cannot be empty.';

$this->errorMsg['minStockQty'][1] = 'Minimum stock cannot be empty.';
$this->errorMsg['minStockQty'][2] = 'Stok Min. harus lebih besar atau sama dengan 0.'; 

$this->errorMsg['news'][1] = 'News title cannot be empty.';
$this->errorMsg['news'][2] = 'The news title already exists. Please choose another news title.';

$this->errorMsg['orderList'][1] = 'Serial number cannot be empty.';
$this->errorMsg['orderList'][2] = 'Serial number must contain numeric.';

$this->errorMsg['page'][1] = 'Page name cannot be empty.';
$this->errorMsg['page'][2] = 'The page name already exists. Please choose another page name.';
 
$this->errorMsg['paymentConfirmation'][1] = 'Sales order not found.'; 
$this->errorMsg['paymentConfirmation'][2] = 'Sales order has been paid.';
    
$this->errorMsg['password'][1] = 'Password cannot be empty.';
$this->errorMsg['password'][2] = 'Password must be between 5 to 30 characters long.';
$this->errorMsg['password'][3] = 'Password and password confirmation did not match.';

$this->errorMsg['passwordConfirmation'][1] = 'Password confirmation cannot be empty.';
$this->errorMsg['passwordConfirmation'][2] = 'Password confirmation must be between 5 to 30 characters long.';

$this->errorMsg['paymentMethod'][1] = 'Payment method cannot be empty.';
$this->errorMsg['paymentMethod'][2] = 'Payment method already exists. Please choose anther payment method.';

$this->errorMsg['phone'][1] = 'Phone number cannot be empty.';

$this->errorMsg['point'][1] = 'Point cannot be empty.';
$this->errorMsg['point'][2] = 'The total point must be bigger than 0.';
$this->errorMsg['point'][3] = 'Total point is insufficient.';

$this->errorMsg['portfolio'][1] = 'Portfolio name cannot be empty.';
$this->errorMsg['portfolio'][2] = 'Portfolio name already exists. Please choose anther name.';

$this->errorMsg['print'][1] = 'Anda belum memilih data yang hendak dicetak.';

$this->errorMsg['qty'][1] = 'Qty must be bigger than 0.';  

$this->errorMsg['rating'][1] = 'Rating must between 1 to 5.'; 

$this->errorMsg['review'][1] = 'Review cannot be empty.'; 

$this->errorMsg['sellingPrice'][1] = 'Price cannot be empty.';
$this->errorMsg['sellingPrice'][2] = 'Price must be bigger or same as 0.'; 
$this->errorMsg['sellingPrice'][3] = 'Price must be bigger than 0.'; 


$this->errorMsg['slot'][1] = 'Slot cannot be empty.';
$this->errorMsg['slot'][2] = 'Slot must be bigger or same as 0.';  
$this->errorMsg['slot'][3] = 'Slot must be bigger than 0.';  

$this->errorMsg['script'][1] = 'Script cannot be empty.';
  
$this->errorMsg['shipment'][1] = 'Shipment cannot be empty.';
$this->errorMsg['shipment'][2] = 'Shipment method already exists. Please choose anther shipment.'; 

$this->errorMsg['shipmentTracking'][1] = 'Tracking number cannot be empty.'; 

$this->errorMsg['subject'][1] = 'Subject cannot be empty.';

$this->errorMsg['supplier'][1] = 'Supplier name cannot be empty.';

$this->errorMsg['title'][1] = 'Title method cannot be empty.';
$this->errorMsg['title'][2] = 'Title method already exists. Please choose another title.';

$this->errorMsg['top'][1] = 'Payment method cannot be empty.';
$this->errorMsg['top'][2] = 'Payment method already exists. Please choose another payment method.';

$this->errorMsg['url'][1] = 'URL cannot be empty.';
$this->errorMsg['url'][2] = 'URL already exists. Please choose another URL.';
$this->errorMsg['url'][3] = 'URL is not valid.';

$this->errorMsg['warehouse'][1] = 'Warehouse name cannot be empty.';
$this->errorMsg['warehouse'][2] = 'Warehouse name already exists. Please choose another warehouse name.';

$this->errorMsg['youtube'][1] = 'Youtube title cannot be empty.';
$this->errorMsg['youtube'][2] = 'Youtube title already exists. Please choose another youtube title.';


// WEB CONTENT  
$this->lang['aboutus'] = 'About Us' ;
$this->lang['accountsPayable'] = 'Accounts Payable' ;
$this->lang['accountsPayablePayment'] = 'Accounts Payable Payment' ; 
$this->lang['accountsReceivable'] = 'Accounts Receivable' ;
$this->lang['accountsReceivablePayment'] = 'Accounts Receivable Payment' ;
$this->lang['accountsPayableReport'] = 'Accounts Payable Report' ;
$this->lang['addToCart'] = 'Add to Cart' ;
$this->lang['APReport'] = 'AP Report' ;
$this->lang['accountsPayablePaymentReport'] = 'Accounts Payable Payment Report' ; 
$this->lang['APPaymentReport'] = 'AP Payment Report' ;
$this->lang['accountsReceivableReport'] = 'Accounts Receivable Report' ;
$this->lang['ARReport'] = 'AR Report' ;
$this->lang['accountsReceivablePaymentReport'] = 'Accounts Receivable Payment Report' ;
$this->lang['ARPaymentReport'] = 'AR Payment Report' ;
$this->lang['activationEmail'] = 'Activation Email' ;
$this->lang['accountActivation'] = 'Account Activation' ;
$this->lang['accountActivationSuccessful'] = 'Congratulations, your account has been activated!<br>Now you can start logging in accessing our member features, have fun !' ;
$this->lang['accountRecovery'] = 'Account Recovery' ;
$this->lang['add'] = 'Add';
$this->lang['addSearchFilter'] = 'Add Search Filter';
$this->lang['address'] = 'Address' ;
$this->lang['addRows'] = 'Add Rows' ;
$this->lang['addToCart'] = 'Add to Cart' ;
$this->lang['allCategories'] = 'All Categories' ;
$this->lang['allProducts'] = 'All Products';
$this->lang['amount'] = 'Amount';
$this->lang['article'] = 'Article';
$this->lang['articleCategory'] = 'Article Category'; 
$this->lang['articleNewsAndMedia'] = 'Article, News &amp; Media';  
$this->lang['ar/ap'] = 'AR / AP' ;
$this->lang['availability'] = 'Availability';

$this->lang['backTo'] = 'Back to';
$this->lang['backToTop'] = 'Back to Top';
$this->lang['balanceSheetReport'] = 'Balance Sheet Report';
$this->lang['banner'] = 'Banner';
$this->lang['bankName'] = 'Bank Name';
$this->lang['bankAccountName'] = 'Account Name';
$this->lang['bankAccountNumber'] = 'Account Number';
$this->lang['billingStatement'] = 'Billing Statement'; 
$this->lang['brand'] = 'Brand';
$this->lang['businessPartner'] = 'Business Partner';  

$this->lang['cart'] = 'Cart';
$this->lang['cartSubmitSuccessful'] = 'Your order has been submitted. You will receive an invoice with billing details and payment information in your email soon.';
$this->lang['chartOfAccount'] = 'Chart of Account';
$this->lang['cashBankTransfer'] = 'Cash Bank Transfer';
$this->lang['cashIn'] = 'Cash In';
$this->lang['cashMovementReport'] = 'Cash Movement Report';
$this->lang['cashOut'] = 'Cash Out'; 
$this->lang['clearTag'] = 'Clear Tag';
$this->lang['checkOut'] = 'Check Out';
$this->lang['changeStatus'] = 'Change Status';
$this->lang['chooseStatus'] = 'Choose Status';
$this->lang['clickHere'] = 'Click Here'; 
$this->lang['close'] = 'Close'; 
$this->lang['closed'] = 'Closed'; 
$this->lang['closingDate'] = 'Closing Date'; 
$this->lang['code'] = 'Code';
$this->lang['codeSetting'] = 'Code Setting';
$this->lang['confirm'] = 'Confirm';
$this->lang['contact'] = 'Contact';
$this->lang['contactUs'] = 'Contact Us';
$this->lang['contactUsSuccessful'] =  'Your message has been sent and we will be in touch with you as soon as possible.'; 
$this->lang['currencyList'] = 'Currency List';    
$this->lang['currencyRate'] = 'Currency Rate';    
$this->lang['currentPassword'] = 'Current Password';  
$this->lang['customer'] = 'Customer';  

$this->lang['dataHasBeenSuccessfullyUpdated'] = 'Data has been successfully updated.'; 
$this->lang['date'] = 'Date';
$this->lang['delete'] = 'Delete';
$this->lang['deselectAll'] = 'Deselect All';
$this->lang['discount'] = 'Discount';

$this->lang['edit'] = 'Edit';
$this->lang['email'] = 'Email';
$this->lang['emailSentSuccessful'] = 'Email has been successfully sent.'; 
$this->lang['employee'] = 'Employee';  
$this->lang['employeeDivision'] = 'Employee Division';  
$this->lang['emptyFieldPasswordDontChange'] = 'Empty field <strong>New Password</strong> if you do not want to change your password.';
$this->lang['eta'] = 'ETA';
$this->lang['etccost'] = 'Cost'; 
$this->lang['event'] = 'Event';

$this->lang['filterCategory'] = 'Filter Category';
$this->lang['finance'] = 'Finance';
$this->lang['followUs'] = 'Follow Us';

$this->lang['forgotPassword'] = 'Forgot Password';
$this->lang['forgotPasswordMessage'] = 'Please enter the email address you used to register with us.';
 
$this->lang['gallery'] = 'Gallery';

$this->lang['GL'] = 'GL';
$this->lang['generalJournal'] = 'General Journal';
$this->lang['generalJournalReport'] = 'General Journal Report'; 

$this->lang['hideNotAvailableItem'] = 'Hide Not Available Item'; 

$this->lang['hideDetail'] = 'Hide Detail';
$this->lang['home'] = 'Home'; 

$this->lang['import'] = 'Import'; 
$this->lang['incomeStatementReport'] = 'Income Statement Report'; 
$this->lang['indexRandomProductTitle'] = 'Our Products'; 
$this->lang['inThousand'] = 'in Thousand';  
$this->lang['invoice'] = 'Invoice';
$this->lang['invoiceId'] = 'Invoice ID';
$this->lang['item'] = 'Item';
$this->lang['itemAdjustment'] = 'Item Adjustment'; 
$this->lang['itemReport'] = 'Item Report';
$this->lang['itemCategory'] = 'Item Category';
$this->lang['itemFilter'] = 'Item Filter'; 
$this->lang['itemFilterReport'] = 'Item Filter Report'; 
$this->lang['itemIn'] = 'Item In'; 
$this->lang['itemInReport'] = 'Item In Report'; 
$this->lang['itemMovement'] = 'Item Movement'; 
$this->lang['itemName'] = 'Item Name';
$this->lang['itemOut'] = 'Item Out'; 
$this->lang['itemOutReport'] = 'Item Out Report'; 
$this->lang['itemUnit'] = 'Item Unit';
$this->lang['item(s)'] = 'Item(s)';
$this->lang['inStock'] = 'In Stock';
$this->lang['insurance'] = 'Insurance';
$this->lang['inventory'] = 'Inventory';
$this->lang['inventoryList'] = 'Item List';
$this->lang['inventoryPreorderList'] = 'Preorder Item'; 

$this->lang['limited'] = 'Limited';
$this->lang['loading'] = 'Loading';
$this->lang['login'] = 'Login';
$this->lang['loginRequired'] = 'You must be log in first.';
$this->lang['loginSuccessful'] = 'Log in successful. You will be redirected to main page.';
$this->lang['logout'] = 'Logout';
$this->lang['lowStock'] = 'Low Stock'; 

$this->lang['max'] = 'Max.';
$this->lang['message'] = 'Message';

$this->lang['name'] = 'Name';
$this->lang['newPassword'] = 'New Password';
$this->lang['newPasswordConfirmation'] = 'New Password Confirmation';
$this->lang['news'] = 'News';
$this->lang['newsCategory'] = 'News Category'; 
$this->lang['nextPage'] = 'Next Page';
$this->lang['noDescriptionAvailable'] = 'No description available.'; 
$this->lang['noDataFound'] = 'No data found.';
$this->lang['normalPrice'] = 'Normal Price';
$this->lang['note'] = 'Note';
$this->lang['notificationSuccessMessage'] = 'We will email you when the item has arrived.';
$this->lang['notifyMe'] = 'Notify me when available.';

$this->lang['orderList'] = 'Order List';
$this->lang['others'] = 'Others';
$this->lang['outOfStock'] = 'Out of Stock';
$this->lang['overdueAccountsPayable'] = 'Overdue Accounts Payable';
$this->lang['overdueAccountsReceivable'] = 'Overdue Accounts Receivable';
$this->lang['overStock'] = 'Over Stock';

$this->lang['page'] = 'Page';
$this->lang['pawn'] = 'Pawn';
$this->lang['paymentConfirmation'] = 'Payment Confirmation';
$this->lang['paymentConfirmationSuccessful'] =  'Your confirmation has been sent and we will process as soon as possible.'; 
$this->lang['paymentDate'] = 'Payment Date';
$this->lang['pleaseReopenAndSaveTheData']= 'Please re-open and save the data';
$this->lang['password'] = 'Password';
$this->lang['passwordConfirmation'] = 'Password Confirmation'; 
$this->lang['paymentMethod'] = 'Payment Method';
$this->lang['phone'] = 'Phone';
$this->lang['poList'] = 'PO List';
$this->lang['point'] = 'Point';
$this->lang['pointofsales'] = 'Point of Sales';
$this->lang['pointValue'] = 'Point Value';
$this->lang['pointReport'] = 'Point Report';
$this->lang['poPrice'] = 'PO Price';
$this->lang['portfolio'] = 'Portfolio';
$this->lang['portfolioCategory'] = 'Portfolio Category';
$this->lang['preorderSales'] = 'Preorder Sales';
$this->lang['products'] = 'Products';
$this->lang['profit'] = 'Profit';
$this->lang['productCategories'] = 'Product Categories';
$this->lang['productDescription'] = 'Product Description';
$this->lang['profile'] = 'Profile';
$this->lang['promoAndCampaign'] = 'Promo &amp; Campaign';
$this->lang['promoItem'] = 'Promo Item'; 
$this->lang['promoTitle'] = 'This Week Promo';
$this->lang['preorder'] = 'Pre-Order';
$this->lang['price'] = 'Price';
$this->lang['print'] = 'Print';
$this->lang['printInvoice'] = 'Print Invoice';
$this->lang['purchase'] = 'Purchase';
$this->lang['purchaseReturn'] = 'Purchase Return';
$this->lang['purchaseReport'] = 'Purchase Report';

$this->lang['qty'] = 'Qty';
$this->lang['quickSearch'] = 'Quick Search';

$this->lang['registration'] = 'Registration';
$this->lang['registrationReActivation'] = 'If you have previously registered, you do not need to register again.  Please click <a href="/resend-activation">this link</a> to resend your activation email.'; 
$this->lang['register'] = 'Register' ;
$this->lang['registrationSuccessMessage'] = 'Your registration has been complete. You will receive email and email with the activation information.';
$this->lang['report'] = 'Report'; 
$this->lang['resendActivation'] = 'Resend Activation';
$this->lang['resendActivationMessage'] = 'Please enter the email address you used to register with us.';
$this->lang['resendActivationSuccessMessage'] = 'Your request has been submitted successfully. An email has been sent to you with instructions to activate your account. Thank You.';
$this->lang['resetPassword'] = 'Reset Password';
$this->lang['resetPasswordSuccessful'] =  'You have successfully reset your password. A new password has been sent to your email.';
$this->lang['resetPasswordSuccessMessage'] = 'Your request has been submitted successfully. An email has been sent to you with instructions to reset your password. Thank You.';

$this->lang['refresh'] = 'Refresh'; 
$this->lang['restockList'] = 'Restock List'; 
$this->lang['reward'] = 'Reward';
$this->lang['rewardPoints'] = 'Reward Points'; 

$this->lang['sales'] = 'Sales';
$this->lang['salesReturn'] = 'Sales Return';
$this->lang['salesGraph'] = 'Sales Graph';
$this->lang['salesReport'] = 'Sales Report';
$this->lang['save'] = 'Save';
$this->lang['search'] = 'Search';
$this->lang['searchFilter'] = 'Search Filter';
$this->lang['searchResult'] = 'Search Results'; 
$this->lang['selectAll'] = 'Select All';
$this->lang['send'] = 'Send'; 
$this->lang['services'] = 'Services'; 
$this->lang['setting'] = 'Setting';
$this->lang['settlementType'] = 'Settlement Type'; 
$this->lang['shipment'] = 'Shipment';
$this->lang['shipmentFee'] = 'Shipment Fee';
$this->lang['shipmentReceipt'] = 'Shipment Receipt';
$this->lang['shippingInformation'] = 'Shipping Information';
$this->lang['showDetail'] = 'Show Detail';
$this->lang['showInvoice'] = 'Show Invoice';
$this->lang['slot'] = 'Slot';
$this->lang['stock'] = 'Stock';
$this->lang['stockCardReport'] = 'Stock Card Report';
$this->lang['status'] = 'Status';
$this->lang['subject'] = 'Subject';
$this->lang['subtotal'] = 'Subtotal';
$this->lang['supplier'] = 'Supplier';

$this->lang['tag'] = 'Tag';
$this->lang['tax'] = 'Tax';
$this->lang['testimonial'] = 'Testimonial';
$this->lang['total'] = 'Total';
$this->lang['totalData'] = 'Total Data';
$this->lang['totalPoint'] = 'Total Point';
$this->lang['transactionHistory'] = 'Transaction History';

$this->lang['underMaintenance'] = 'Under Maintenance';
$this->lang['unproccesedSalesOrder'] = 'Unproccesed Sales Order'; 
$this->lang['unproccesedPurchaseOrder'] = 'Unproccesed Purchase Order'; 
$this->lang['updateSearchFilter'] = 'Update Search Filter';
$this->lang['username'] = 'Username'; 
$this->lang['useInsurance'] = 'Use Insurance'; 

$this->lang['variableSetting'] = 'Variable Setting';
$this->lang['viewOrEdit'] = 'View / Edit';

$this->lang['warehouse'] = 'Warehouse';
$this->lang['warehouseTransfer'] = 'Warehouse Transfer';
$this->lang['warehouseTransferReport'] = 'Warehouse Transfer Report';
$this->lang['webpage'] = 'Web Page';
$this->lang['welcome'] = 'Welcome';

$this->lang['youtube'] = 'Youtube';

$this->lang['activationEmailContent'] = 'Dear {{CUSTOMER_NAME}},
									 <br>
									Thank you for creating an account, you\'re almost done! To complete your registration, click on the link below to verify your account and email address.
									<br><br> 
									{{ACTIVATION_LINK}}
									<br><br> 
									Best Regards,<br>
									{{COMPANY_NAME}}
								';
								
$this->lang['resetPasswordRequestEmailContent'] = 'Dear {{CUSTOMER_NAME}},
			 <br>
			 You or someone has used this email to reset password. Please click the following link to reset password.<br> 
			{{RESET_PASSWORD_LINK}}
			 <br><br> 
			Best Regards,<br>
			{{COMPANY_NAME}}';
	
			
$this->lang['resetPasswordContent'] =  '
					Dear {{CUSTOMER_NAME}},
					 <br>
					  Your password has been reset to <strong>{{NEW_PASSWORD}}</strong><br><br>
					Best Regards,<br>
					{{COMPANY_NAME}}
				'; 										

?>
