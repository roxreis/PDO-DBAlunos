<?php 
   include_once('config/conexao.php');


    $db = conectarBanco();
    $query = $db->query('SELECT * from alunos');
    $alunos = $query->fetchALL(PDO::FETCH_ASSOC);
    // recuperando o id do aluno na url
    

    if(isset($_GET['id'])){
        $id = $_GET['id'];

    }elseif ($_POST['íd']) {
        $id = $_POST['íd'];
    }else{
        echo "Voce deve informar o id"; 
        exit;
    }


    $query = $db->prepare('SELECT * from alunos WHERE id=?');
    $query->execute(['id']);
    $aluno = $query->fetch(PDO::FETCH_ASSOC);

    if($_POST) != []){
        $nomeAluno = $_POST['nomeAluno'];
        $raAluno = $_POST['raAluno'];
        $cursoId = $_POST['curso'];
        $id = $_POST['id'];
        
        $query = $db->prepare('UPDATE alunos SET nome=:nome, ra =:ra, curso_id=:curso_id WHERE id=:id');

        $query->execute([
            'id'=>$id,
            'curso_id'=> $curso_id,
            'ra'=> $raAluno,
            'nome'=> $nomeAluno
        ]);

    }

    

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

    <form action="" method='post'>
        <input type="text" name="id" readonly hidden value="<?= $id; ?>">
        <h2>Nome Aluno</h2>
        <input type="text" name="nomeAluno"  value= "<?= $aluno['nome']; ?>">
        <h2>Ra do Aluno</h2>
        <input type="text" name="raAluno" value= "<?= $aluno['RA'];?>" readonly>
        <h2>Cursos Disponíveis</h2>
        <select name="curso">
            <?php foreach($cursos as $curso): ?>

                <?php if($curso['id'] == $aluno['curso_id']): ?>
                    <option select value="<?= $curso['id']; ?>">
                        <?= $curso['nome']; ?>
                    </option>
                    <?php else:?>   

                        <option value="<?= $curso['id']; ?>">
                            <?= $curso['nome']; ?>
                        </option>

                <?php endif;?>

             <?php endforeach; ?>
        
        </select>
        <button type="submit">Salvar Alterações</button>
   
    
    </form>

</body>
</html>