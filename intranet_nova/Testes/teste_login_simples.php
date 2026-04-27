<?php
session_start();
require_once("config/compatibility.php");

echo "<h1>🔍 Teste de Login - Sistema Intranet</h1>";

// Teste 1: Verificar se a conexão está funcionando
echo "<h2>1. Teste de Conexão com Banco</h2>";
try {
    $drive->conecta();
    echo "✅ Conexão estabelecida com sucesso!<br>";
    
    // Teste 2: Verificar se a tabela uni_usuarios existe
    echo "<h2>2. Teste da Tabela uni_usuarios</h2>";
    $sql = "SELECT COUNT(*) as total FROM uni_usuarios";
    $result = $drive->pedido($sql);
    $row = pg_fetch_object($result);
    
    if ($row) {
        echo "✅ Tabela uni_usuarios encontrada! Total de usuários: " . $row->total . "<br>";
        
        // Teste 3: Mostrar alguns usuários de exemplo
        echo "<h2>3. Usuários de Exemplo</h2>";
        $sql = "SELECT user_id, user_nome, user_login, user_maticula, user_entidade_id FROM uni_usuarios LIMIT 5";
        $result = $drive->pedido($sql);
        
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Login</th><th>Matrícula</th><th>Entidade ID</th></tr>";
        
        while ($user = pg_fetch_object($result)) {
            echo "<tr>";
            echo "<td>" . $user->user_id . "</td>";
            echo "<td>" . htmlspecialchars($user->user_nome) . "</td>";
            echo "<td>" . htmlspecialchars($user->user_login) . "</td>";
            echo "<td>" . htmlspecialchars($user->user_maticula) . "</td>";
            echo "<td>" . $user->user_entidade_id . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
    } else {
        echo "❌ Erro ao acessar tabela uni_usuarios<br>";
    }
    
    // Teste 4: Verificar tabela de permissões
    echo "<h2>4. Teste da Tabela intranet_permissoes</h2>";
    $sql = "SELECT COUNT(*) as total FROM intranet_permissoes";
    $result = $drive->pedido($sql);
    $row = pg_fetch_object($result);
    
    if ($row) {
        echo "✅ Tabela intranet_permissoes encontrada! Total de permissões: " . $row->total . "<br>";
    } else {
        echo "❌ Erro ao acessar tabela intranet_permissoes<br>";
    }
    
    // Teste 5: Verificar tabela de perfis
    echo "<h2>5. Teste da Tabela intranet_perfil</h2>";
    $sql = "SELECT COUNT(*) as total FROM intranet_perfil";
    $result = $drive->pedido($sql);
    $row = pg_fetch_object($result);
    
    if ($row) {
        echo "✅ Tabela intranet_perfil encontrada! Total de perfis: " . $row->total . "<br>";
        
        // Mostrar perfis disponíveis
        $sql = "SELECT intranet_perfil_id, intranet_perfil_nome FROM intranet_perfil";
        $result = $drive->pedido($sql);
        
        echo "<h3>Perfis Disponíveis:</h3>";
        echo "<ul>";
        while ($perfil = pg_fetch_object($result)) {
            echo "<li>" . $perfil->intranet_perfil_id . " - " . htmlspecialchars($perfil->intranet_perfil_nome) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "❌ Erro ao acessar tabela intranet_perfil<br>";
    }
    
    $drive->close();
    
} catch (Exception $e) {
    echo "❌ Erro na conexão: " . $e->getMessage() . "<br>";
}

// Teste 6: Simular login
echo "<h2>6. Teste de Simulação de Login</h2>";
echo "<form method='POST' style='background: #f5f5f5; padding: 20px; border-radius: 8px;'>";
echo "<h3>Teste de Login</h3>";
echo "<p><strong>Matrícula:</strong> <input type='text' name='test_matricula' placeholder='Digite uma matrícula' style='padding: 8px; width: 200px;'></p>";
echo "<p><strong>Senha:</strong> <input type='password' name='test_senha' placeholder='Digite uma senha' style='padding: 8px; width: 200px;'></p>";
echo "<p><input type='submit' value='Testar Login' style='background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;'></p>";
echo "</form>";

// Processar teste de login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['test_matricula'])) {
    $login = $_POST['test_matricula'];
    $senha = $_POST['test_senha'];
    
    echo "<h3>Resultado do Teste:</h3>";
    
    if (empty($login) || empty($senha)) {
        echo "❌ Matrícula e senha são obrigatórios<br>";
    } else {
        try {
            $drive->conecta();
            
            // Buscar usuário
            $sqlUser = "SELECT * FROM uni_usuarios WHERE 
                        user_login = '$login' OR 
                        user_login = '" . md5($login) . "' OR 
                        user_id = '$login' OR 
                        user_maticula = '$login' OR 
                        user_maticula = '" . md5($login) . "'";
            
            $TreturnUser = $drive->pedido($sqlUser);
            $TuserDados = pg_fetch_object($TreturnUser);
            
            if ($TuserDados) {
                echo "✅ <strong>Usuário encontrado!</strong><br>";
                echo "ID: " . $TuserDados->user_id . "<br>";
                echo "Nome: " . htmlspecialchars($TuserDados->user_nome) . "<br>";
                echo "Login: " . htmlspecialchars($TuserDados->user_login) . "<br>";
                echo "Matrícula: " . htmlspecialchars($TuserDados->user_maticula) . "<br>";
                echo "Entidade ID: " . $TuserDados->user_entidade_id . "<br>";
                
                // Verificar permissões
                $sqlPerfil = "SELECT * FROM intranet_permissoes WHERE intranet_user_id = " . $TuserDados->user_id . " AND intranet_entidade_id = " . $TuserDados->user_entidade_id;
                $TreturnPerfil = $drive->pedido($sqlPerfil);
                $TperfilDados = pg_fetch_object($TreturnPerfil);
                
                if ($TperfilDados) {
                    echo "Perfil ID: " . $TperfilDados->intranet_perfil_id . "<br>";
                    
                    // Buscar nome do perfil
                    $sqlPerfilNome = "SELECT intranet_perfil_nome FROM intranet_perfil WHERE intranet_perfil_id = " . $TperfilDados->intranet_perfil_id;
                    $TreturnPerfilNome = $drive->pedido($sqlPerfilNome);
                    $TperfilNome = pg_fetch_object($TreturnPerfilNome);
                    
                    if ($TperfilNome) {
                        echo "Perfil: " . htmlspecialchars($TperfilNome->intranet_perfil_nome) . "<br>";
                    }
                } else {
                    echo "⚠️ Nenhuma permissão encontrada para este usuário/entidade<br>";
                }
                
                echo "<br><strong>🎉 Login seria bem-sucedido!</strong><br>";
                
            } else {
                echo "❌ <strong>Usuário não encontrado</strong><br>";
                echo "Matrícula/Login testado: " . htmlspecialchars($login) . "<br>";
            }
            
            $drive->close();
            
        } catch (Exception $e) {
            echo "❌ Erro no teste: " . $e->getMessage() . "<br>";
        }
    }
}

echo "<hr>";
echo "<h2>🔗 Links Úteis</h2>";
echo "<p><a href='login.php' style='color: #007cba;'>→ Ir para página de login</a></p>";
echo "<p><a href='index.php' style='color: #007cba;'>→ Ir para index</a></p>";
echo "<p><a href='verificar_tabelas_existentes.php' style='color: #007cba;'>→ Verificar tabelas do banco</a></p>";
?>
