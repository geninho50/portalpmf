<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste do Calendário Corrigido - Intranet PMF</title>
    
    <!-- CSS Moderno -->
    <link rel="stylesheet" href="assets/css/modern.css">
    <link rel="stylesheet" href="assets/css/components.css">
    
    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: var(--secondary-50);
            padding: 20px;
            margin: 0;
        }
        
        .test-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: var(--secondary-800);
            margin-bottom: 20px;
            text-align: center;
        }
        
        .calendar-test {
            margin-top: 30px;
        }
        
        /* Estilos específicos para teste */
        #calendar-widget {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .debug-info {
            background: var(--secondary-100);
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 14px;
            color: var(--secondary-700);
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>🧪 Teste do Calendário Corrigido</h1>
        
        <p>Este é um teste para verificar se o calendário está exibindo corretamente em formato de grade.</p>
        
        <div class="calendar-test">
            <div id="calendar-widget"></div>
        </div>
        
        <div class="debug-info">
            <strong>Informações de Debug:</strong><br>
            - O calendário deve exibir os dias em uma grade 7x6<br>
            - Cada dia deve ter formato quadrado<br>
            - Os dias devem estar alinhados corretamente<br>
            - A navegação entre meses deve funcionar
        </div>
    </div>

    <!-- JavaScript -->
    <script src="assets/js/calendar.js"></script>
    <script>
        // Inicializar calendário quando o DOM estiver pronto
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Inicializando calendário corrigido...');
            
            const calendarWidget = document.getElementById('calendar-widget');
            if (calendarWidget) {
                console.log('Container do calendário encontrado');
                const calendar = new Calendar('calendar-widget');
                console.log('Calendário inicializado com sucesso');
                
                // Debug: verificar se os elementos foram criados
                setTimeout(() => {
                    const days = document.querySelectorAll('.calendar-day');
                    const weekdays = document.querySelectorAll('.calendar-weekdays span');
                    console.log(`Dias criados: ${days.length}`);
                    console.log(`Dias da semana: ${weekdays.length}`);
                    
                    if (days.length === 42) {
                        console.log('✅ Calendário criado corretamente com 42 dias');
                    } else {
                        console.log('❌ Problema: número incorreto de dias');
                    }
                }, 100);
            } else {
                console.error('Container do calendário não encontrado');
            }
        });
    </script>
</body>
</html>
