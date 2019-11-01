<?php 
   include_once('config/conexao.php');


    $db = conectarBanco();
    $query = $db->query('SELECT * from cursos');
    $cursos = $query->fetchALL(PDO::FETCH_ASSOC);
    // recuperando o id do aluno na url
    

    if(isset($_GET['id'])){
        $id = $_GET['id'];

    }else{
        echo "Voce deve informar o id"; 
    }


    $query = $db->prepare('SELECT * from alunos WHERE id=?');
    $aluno = $query->execute([id]);
    $aluno = $aluno->fetch(PDO::FETCH_ASSOC);

    var_dump($aluno);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="cadastroAluno.php" method='post'>
        <h2>Nome Aluno</h2>
        <input type="text" name="nomeAluno">
        <h2>Ra do Aluno</h2>
        <input type="text" name="raAluno">
        <h2>Cursos Disponíveis</h2>
        <select name="curso">
            <?php foreach($cursos as $curso): ?>
                <option value="<?= $curso['id']; ?>">
                    <?= $curso['nome']; ?>
                </option>
             <?php endforeach; ?>
        
        </select>
        <button type="submit">Cadastrar</button>
   
    
    </form>

</body>
</html>