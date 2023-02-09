<html>
    <head>
        
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <title>Formulaire Hash/Chiffrement/déchiffrement</title>
    </head>
    </head>
    <body>
        <div class="container-fluid" >
            <div style="width: 50%; padding: 20px; float: left;">
                <h3>Chiffrement / Hash</h3>
                <form action="index.php" method="post">
                    <p>Entrez le texte à chiffrer/hasher :</p>
                    <input   class="form-control" type="text" name="text_to_encrypt">
                    <p>Sélectionnez l'algorithme de chiffrement :</p>
                    <select  name="encryption_algorithm">
                        <option value="md5">MD5</option>
                        <option value="sha256">SHA256</option>
                        <option value="keccak512">Keccak-512</option>
                        <option value="ripemd160">RipeMD160</option>
                        <option value="aes">AES</option>
                        <option value="rsa">RSA</option>
                    </select>
                    <p>Entrez votre clé de chiffrement (optionnel) :</p>
                    <input  class="form-control"  type="text" name="encryption_key">
                    <br><br>
                    <input type="submit" value="Chiffrer">
                </form>
                <?php
                    if (isset($_POST['text_to_encrypt'])) {
                        $text_to_encrypt = $_POST['text_to_encrypt'];
                        $encryption_algorithm = $_POST['encryption_algorithm'];
                        $encryption_key = $_POST['encryption_key'];

                        switch ($encryption_algorithm) {
                            case "md5":
                                $encrypted_text = md5($text_to_encrypt);
                                break;
                            case "sha256":
                                $encrypted_text = hash('sha256', $text_to_encrypt);
                                break;
                            case "keccak512":
                                $encrypted_text = hash('sha3-512', $text_to_encrypt);
                                break;
                            case "ripemd160":
                                $encrypted_text = hash('ripemd160', $text_to_encrypt);
                                break;
                            case "aes":
                                if (empty($encryption_key)) {
                                    echo "Veuillez entrer une clé de chiffrement pour AES";
                                } else {
                                    $encrypted_text = openssl_encrypt($text_to_encrypt, 'AES-128-CBC', $encryption_key);
                                }
                                break;
                            case "rsa":
                                if (empty($encryption_key)) {
                                    echo "Veuillez entrer une clé de chiffrement pour RSA";
                                } else {
                                    $encrypted_text = openssl_encrypt($text_to_encrypt, 'AES-128-CBC', $encryption_key);

                                  
                                }
                                break;
                        }

                        if (!empty($encrypted_text)){
                        echo "Texte chiffré : " . $encrypted_text;
                    }
                }
            ?>
        </div>
        <div style="width: 50%; padding: 20px; float: right;">
            <h3>Déchiffrement</h3>
            <form action="index.php" method="post">
                <p>Entrez le texte à déchiffrer :</p>
                <input type="text" name="text_to_decrypt">
                <p>Sélectionnez l'algorithme de déchiffrement :</p>
                <select name="decryption_algorithm">
                    <option value="aes">AES</option>
                    <option value="rsa">RSA</option>
                </select>
                <p>Entrez votre clé de déchiffrement :</p>
                <input type="text" name="decryption_key">
                <br><br>
                <input type="submit" value="Déchiffrer">
            </form>
            <?php
                if (isset($_POST['text_to_decrypt'])) {
                    $text_to_decrypt = $_POST['text_to_decrypt'];
                    $decryption_algorithm = $_POST['decryption_algorithm'];
                    $decryption_key = $_POST['decryption_key'];

                    switch ($decryption_algorithm) {
                        case "aes":
                            if (empty($decryption_key)) {
                                echo "Veuillez entrer une clé de déchiffrement pour AES";
                            } else {
                                $decrypted_text = openssl_decrypt($text_to_decrypt, 'AES-128-CBC', $decryption_key);
                            }
                            break;
                        case "rsa":
                            if (empty($decryption_key)) {
                                echo "Veuillez entrer une clé de déchiffrement pour RSA";
                            } else {
                                $encrypted_text = openssl_encrypt($text_to_encrypt, 'AES-128-CBC', $encryption_key);

                            }
                            break;
                    }

                    if (!empty($decrypted_text)) {
                        echo "Texte déchiffré : " . $decrypted_text;
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>
