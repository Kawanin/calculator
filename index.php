<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <header>
        <h1> Calculadora </h1>
    </header>
    <div class="calculadora">
        <form action=" " method="POST">
            <input type="text" id="display" name="display" value="">
            <div class="buttons">
                <button type="submit" name="apagar">C</button>
                <button type="submit" name="bt" value=r>√</button>
                <button type="submit" name="bt" value=*>x</button>
                <button type="submit" name="backspace" value="backspace"><</button>
                <button type="submit" name="bt" value= />÷</button>
                <button type="submit" name="bt" value=7>7</button>
                <button type="submit" name="bt" value=8>8</button>
                <button type="submit" name="bt" value=9>9</button>
                <button type="submit" name="bt" value=->-</button>
                <button type="submit" name="bt" value=4>4</button>
                <button type="submit" name="bt" value=5>5</button>
                <button type="submit" name="bt" value=6>6</button>
                <button type="submit" name="bt" value=+>+</button>
                <button type="submit" name="bt" value=1>1</button>
                <button type="submit" name="bt" value=2>2</button>
                <button type="submit" name="bt" value=3>3</button>
                <button type="submit" name="bt" value=!>!</button>
                <button type="submit" name="bt" value=0>0</button>
                <button type="submit">.</button>
                <button type="submit" name="bt" value="=">=</button>
            </div>
        </form>
    </div>

    <footer>
        <p>Calculadora - Desenvolvimento de Software UP</p>
        <p>Aluno: Luciano M. Kawano Junior</p>
        <p>E-mail: l.kawano.jr@gmail.com</p>
    </footer>

    <?php

    if (isset($_POST['apagar']) and isset($_POST['display'])) {
        $display = $_POST['display'];
        
        echo "<script>";
        echo "document.getElementById('display').value = '" . null . "';";
        echo "</script>";
    }

    if (isset($_POST['backspace'])) {
        $display = $_POST['display'];

        if (strlen($display) > 0) {
            $novoDisplay = substr($display, 0, -1);
        }

        echo "<script>";
        echo "document.getElementById('display').value = '" . $novoDisplay . "';";
        echo "</script>";

    }

    if (isset($_POST['bt']) and isset($_POST['display'])) {
        $botao = $_POST['bt'];
        $display = $_POST['display'];

        $novoDisplay = $display . $botao;

        if ($botao === "=") {
            $expressao = $display;
            $partes = preg_split('/(?<=[+\-*\/r!])|(?=[+\-*\/r!])/', $expressao);
            $resultado = (float) $partes[0];

            for ($i = 1; $i < count($partes); $i += 2) {
                $operador = $partes[$i];
                $numero = (float) $partes[$i + 1];

                switch ($operador) {
                    case '+':
                        $resultado += $numero;
                        break;
                    case '-':
                        $resultado -= $numero;
                        break;
                    case '*':
                        $resultado *= $numero;
                        break;
                    case '/':
                        if($numero != 0){
                            $resultado /= $numero;
                        } else {
                            $resultado = "Formato inválido";
                        }
                        break;
                    case 'r':
                        $resultado = sqrt($resultado + $numero);
                        break;
                    case '!':
                        $resultado = fatorial($resultado + $numero);
                        break;
                    default:
                        echo "Operador inválido: $operador";
                        break;
                }
            }
            
            echo "<script>";
            echo "document.getElementById('display').value = '" . (is_string($resultado) ? $resultado : number_format($resultado, 2, '.', '')) . "';";
            echo "</script>";

        } else {
            echo "<script>";
            echo "document.getElementById('display').value = '" . $novoDisplay . "';";
            echo "</script>";
        }
    }
    
    function fatorial($numero)
    {
        $numFatorial = 1;
        for ($i = $numero; $i > 1; $i--) {
            $numFatorial *= $i;
        }

        return $numFatorial;
    }
    ?>
</body>

</html>