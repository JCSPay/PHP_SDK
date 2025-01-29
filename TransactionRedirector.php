<?php 

class TransactionRedirector {
    const TOKEN1 = 'set-your-merchantId here'; // Set your actual token1 value here
    const SALTKEY = 'set-your-salt-key-here'; // Set your actual saltKey here
    const URL = 'http://localhost:5173/test3?token1='; // Define your base URL for redirection

    public static function processTransaction() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["error" => "Method Not Allowed. Use POST request."]);
            exit;
        }

        $transactionData = $_POST['transactionData'] ?? null;

        if (!$transactionData) {
            http_response_code(400);
            echo json_encode(["error" => "Missing required transaction data."]);
            exit;
        }

        $transactionDataArray = json_decode($transactionData, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid transaction data format."]);
            exit;
        }

        $requiredFields = ['txnid', 'merchantId', 'productinfo', 'amount', 'email', 'firstname', 'lastname', 'phone', 'mode', 'surl', 'furl'];
        foreach ($requiredFields as $field) {
            if (!isset($transactionDataArray[$field])) {
                http_response_code(400);
                echo json_encode(["error" => "Missing required field: $field"]);
                exit;
            }
        }
        $hashedTransactionKey = (self::SALTKEY);

        $encodedTransactionData = urlencode(json_encode($transactionDataArray));

        $redirectUrl = self::URL . urlencode(self::TOKEN1) . "&saltKey=$hashedTransactionKey&transactionData=$encodedTransactionData";

        header("Location: $redirectUrl");
        exit;
    }
}

TransactionRedirector::processTransaction();

?>
