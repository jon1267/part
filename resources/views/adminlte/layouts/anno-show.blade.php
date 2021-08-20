<script>

    $(function () {
        var anno = new Anno([

            {
                target : '#donesite',
                content: '<center><strong>Поздравляем!</strong></center><br/> Для Вас бесплатно создан ваш индивидуальный, полностью рабочий сайт с помощью которого вы уже можете зарабатывать от 5000 грн в месяц практически на полном пассиве, рекомендуя его друзьям, знакомым и любым другим людям. ',
                // <br/><br/>Последующие подсказки детально опишут функционал Личного Кабинета и пошагово разъяснит как можно начать зарабатывать без вложений уже сейчас!
                position: 'center-top',
                buttons: [AnnoButton.DoneButton, AnnoButton.NextButton]
            },


            {
                target : '#orders',
                content: 'В данном разделе информация по всем поступившим заказам.<br/><br/> А именно: какой товар заказали, на какую сумму, какой ваш заработок и статус заказа, указывающий получен ли заказ клиентом или нет.',
                position: 'center-bottom',
                /*position: 'center-right',*/
                buttons: [AnnoButton.DoneButton, AnnoButton.NextButton]
            },

            {
                target : '#payments',
                content: 'В разделе Мой доход, указан Ваш заработок по оплаченным заказам.<br/><br/> Так же в данном разделе вы делаете запрос на выплату заработанных вами средств на вашу карту.',
                position: 'center-top',
                buttons: [AnnoButton.DoneButton, AnnoButton.NextButton]
            },

            // {
            //   target : '#store',
            //   content: 'В данном разделе вы можете оформить заказ и внести полные данные доставки за клиента, заказ будет отправлен без предварительного звонка с нашего коллцентра.',
            //   position: 'center-bottom',
            //   buttons: [AnnoButton.DoneButton, AnnoButton.NextButton]
            // },

            {
                target : '#profiles',
                content: 'В разделе - Профиль вы указываете ваши контактные данные и реквизиты для выплаты вашего заработка.',
                position: 'center-bottom',
                buttons: [AnnoButton.DoneButton, AnnoButton.NextButton]
            },

            {
                target : '#materials',
                content: 'В данном разделе вы можете получить различные рекламные материалы такие как: шаблон визитки с вашим сайтом для печати и распространения.<br/> Заказать пробники популярных ароматов и другие материалы.',
                position: 'center-bottom',
                buttons: [AnnoButton.DoneButton, AnnoButton.NextButton]
            },

            {
                target : '#hows',
                content: 'В разделе как начать зарабатывать, вы получите исчерпывающую информацию о том как приводить первых клиентов на ваш сайт и все что нужно знать о нашей продукции.',
                position: 'center-bottom',
                buttons: [AnnoButton.DoneButton, AnnoButton.NextButton]
            },


            {
                target : '#contacts',
                content: 'Вы можете написать вашему менеджеру любые вопросы в мессенджеры Telegram и Viber, а так же на почту',
                position: 'center-top',
                buttons: [AnnoButton.DoneButton, AnnoButton.NextButton]
            },

            {
                target : '#helps',
                content: 'Экскурсия по кабинету.',
                position: 'center-bottom',
                buttons: [AnnoButton.DoneButton]
            },

        ]);



        $('.tourSite').click(function(){
            anno.show();
        });
    });

</script>
