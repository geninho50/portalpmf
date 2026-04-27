<?php
session_start();
require_once("config/compatibility.php");

echo "<h1>🔐 Teste de Login - Sistema Intranet</h1>";

// Se já estiver logado, mostrar informações
if (isset($_SESSION['SuserId']) && !empty($_SESSION['SuserId'])) {
    echo "<div style='background: #d4edda; padding: 15px; border-radius: 8px; margin-bottom: 20px;'>";
    echo "<h2>✅ Usuário já logado!</h2>";
    echo "<p><strong>ID:</strong> " . $_SESSION['SuserId'] . "</p>";
    echo "<p><strong>Nome:</strong> " . $_SESSION['SuserNome'] . "</p>";
    echo "<p><strong>Login:</strong> " . $_SESSION['SuserLogin'] . "</p>";
    echo "<p><strong>Entidade:</strong> " . $_SESSION['SuserEnt'] . "</p>";
    echo "<p><strong>Perfil ID:</strong> " . $_SESSION['SuserPerfilId'] . "</p>";
    echo "<p><a href='logout.php' style='color: #007cba;'>→ Fazer Logout</a></p>";
    echo "</div>";
}

// Processar login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['matricula'] ?? '';
    $senha = $_POST['senha'] ?? '';
    
    echo "<h2>🔍 Resultado do Teste de Login</h2>";
    
    if (empty($login) || empty($senha)) {
        echo "<div style='background: #f8d7da; padding: 15px; border-radius: 8px;'>";
        echo "❌ Matrícula e senha são obrigatórios";
        echo "</div>";
    } else {
        try {
            $drive->conecta();
            
            // Buscar usuário (incluindo MD5)
            $sqlUser = "SELECT * FROM uni_usuarios WHERE 
                        user_login = '$login' OR 
                        user_login = '" . md5($login) . "' OR 
                        user_id = '$login' OR 
                        user_maticula = '$login' OR 
                        user_maticula = '" . md5($login) . "'";
            
            $TreturnUser = $drive->pedido($sqlUser);
            $TuserDados = pg_fetch_object($TreturnUser);
            
            if ($TuserDados) {
                echo "<div style='background: #d4edda; padding: 15px; border-radius: 8px;'>";
                echo "<h3>✅ Usuário Encontrado!</h3>";
                echo "<p><strong>ID:</strong> " . $TuserDados->user_id . "</p>";
                echo "<p><strong>Nome:</strong> " . htmlspecialchars($TuserDados->user_nome) . "</p>";
                echo "<p><strong>Login:</strong> " . htmlspecialchars($TuserDados->user_login) . "</p>";
                echo "<p><strong>Matrícula:</strong> " . htmlspecialchars($TuserDados->user_maticula) . "</p>";
                echo "<p><strong>Entidade ID:</strong> " . $TuserDados->user_entidade_id . "</p>";
                
                // Verificar permissões
                $sqlPerfil = "SELECT * FROM intranet_permissoes WHERE intranet_user_id = " . $TuserDados->user_id . " AND intranet_entidade_id = " . $TuserDados->user_entidade_id;
                $TreturnPerfil = $drive->pedido($sqlPerfil);
                $TperfilDados = pg_fetch_object($TreturnPerfil);
                
                if ($TperfilDados) {
                    echo "<p><strong>Perfil ID:</strong> " . $TperfilDados->intranet_perfil_id . "</p>";
                    
                    // Buscar nome do perfil
                    $sqlPerfilNome = "SELECT intranet_perfil_nome FROM intranet_perfil WHERE intranet_perfil_id = " . $TperfilDados->intranet_perfil_id;
                    $TreturnPerfilNome = $drive->pedido($sqlPerfilNome);
                    $TperfilNome = pg_fetch_object($TreturnPerfilNome);
                    
                    if ($TperfilNome) {
                        echo "<p><strong>Perfil:</strong> " . htmlspecialchars($TperfilNome->intranet_perfil_nome) . "</p>";
                    }
                } else {
                    echo "<p><strong>Perfil:</strong> ⚠️ Nenhuma permissão encontrada</p>";
                }
                
                echo "<br><strong>🎉 Login seria bem-sucedido!</strong>";
                echo "<br><a href='login.php' style='color: #007cba;'>→ Ir para página de login real</a>";
                echo "</div>";
                
            } else {
                echo "<div style='background: #f8d7da; padding: 15px; border-radius: 8px;'>";
                echo "<h3>❌ Usuário não encontrado</h3>";
                echo "<p><strong>Matrícula/Login testado:</strong> " . htmlspecialchars($login) . "</p>";
                echo "<p><strong>MD5 do login:</strong> " . md5($login) . "</p>";
                echo "<p>Verifique se a matrícula está correta.</p>";
                echo "</div>";
            }
            
            $drive->close();
            
        } catch (Exception $e) {
            echo "<div style='background: #f8d7da; padding: 15px; border-radius: 8px;'>";
            echo "❌ Erro no teste: " . $e->getMessage();
            echo "</div>";
        }
    }
}

// Mostrar alguns usuários de exemplo para teste
echo "<h2>👥 Usuários de Exemplo para Teste</h2>";
try {
    $drive->conecta();
    $sql = "SELECT user_id, user_nome, user_login, user_maticula FROM uni_usuarios WHERE user_login IS NOT NULL AND user_login != '' LIMIT 5";
    $result = $drive->pedido($sql);
    
    echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 8px;'>";
    echo "<h3>Exemplos de usuários no sistema:</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Login</th><th>Matrícula</th></tr>";
    
    while ($user = pg_fetch_object($result)) {
        echo "<tr>";
        echo "<td>" . $user->user_id . "</td>";
        echo "<td>" . htmlspecialchars($user->user_nome) . "</td>";
        echo "<td>" . htmlspecialchars($user->user_login) . "</td>";
        echo "<td>" . htmlspecialchars($user->user_maticula) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<p><small>💡 <strong>Dica:</strong> Tente usar o ID do usuário como login (ex: 3698)</small></p>";
    echo "</div>";
    
    $drive->close();
} catch (Exception $e) {
    echo "Erro ao buscar usuários: " . $e->getMessage();
}
?>

<h2>🔐 Teste de Login</h2>
<form method="POST" style="background: #f5f5f5; padding: 20px; border-radius: 8px;">
    <p><strong>Matrícula/Login:</strong> <input type="text" name="matricula" placeholder="Digite matrícula ou ID" style="padding: 8px; width: 200px;"></p>
    <p><strong>Senha:</strong> <input type="password" name="senha" placeholder="Digite qualquer senha" style="padding: 8px; width: 200px;"></p>
    <p><input type="submit" value="Testar Login" style="background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;"></p>
</form>

<hr>
<h2>🔗 Links Úteis</h2>
<p><a href="login.php" style="color: #007cba;">→ Ir para página de login real</a></p>
<p><a href="index.php" style="color: #007cba;">→ Ir para index</a></p>
<p><a href="teste_conexao_simples.php" style="color: #007cba;">→ Teste de conexão</a></p>
