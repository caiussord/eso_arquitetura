# ESO Arquitetura

Site institucional demonstrativo para um escritório **fictício** de arquitetura. Os três projetos são estudos conceituais; as fotografias são referências licenciadas e não representam obras executadas pela ESO.

![Capa fotográfica de referência do projeto ESO](wp-content/themes/eso-arquitetura/assets/images/casa-horizonte.jpg)

## O que foi implementado

- Tema WordPress próprio em PHP, HTML, CSS e JavaScript, com home editorial e páginas Sobre, Serviços, Projetos, Contato, Privacidade e 404.
- Plugin `eso-core` com tipos de publicação para projetos, serviços e áreas de atuação. A ativação cria conteúdo demonstrativo editável pelo painel.
- Três cases fictícios identificados, metadados editáveis e imagem destacada opcional. Sem imagem destacada, o tema usa uma fotografia licenciada local.
- Formulário com validação no navegador e servidor, nonce, campo antispam, limite de frequência e envio via `wp_mail`.
- Navegação mobile, accordion com HTML nativo, foco visível, metadados básicos e suporte a movimento reduzido.

## Executar localmente

Requer Docker Desktop com o mecanismo Linux ativo.

1. Copie `.env.example` para `.env` e troque as duas senhas.
2. Execute `docker compose up -d` na raiz do projeto.
3. Acesse `http://localhost:8080` e conclua a instalação do WordPress.
4. No painel, ative o tema **ESO Arquitetura** e o plugin **ESO Core**. A ativação do plugin cria a página inicial, os serviços, as áreas de atuação e os cases.
5. Em **Configurações → Links permanentes**, escolha **Nome do post** e salve.

O ambiente local inclui o Mailpit em `http://localhost:8025` para visualizar mensagens de teste. O plugin usa esse SMTP somente quando a variável `ESO_SMTP_HOST` está definida. Em produção, configure um provedor transacional real.

As imagens padrão ficam no tema. Para substituí-las por imagens da biblioteca do WordPress, use **Imagem destacada** em cada projeto. O texto, metadados e galerias são editáveis no painel. A Política de Privacidade pode ser substituída pelo editor da página. As demais páginas fixas possuem templates próprios; a edição do texto principal delas requer adaptação dos templates.

## Preparar para publicação

- Configure um plugin SMTP transacional confiável e teste a entrega real do formulário. `wp_mail` retornar sucesso não garante recebimento.
- Configure o e-mail administrativo e, em **Aparência → Personalizar → ESO · Contato**, o e-mail público e o número de WhatsApp real. Sem número configurado, o link de WhatsApp permanece oculto.
- Revise a Política de Privacidade conforme o provedor de e-mail e o tratamento real dos dados; a versão inclusa é um ponto de partida demonstrativo.
- Configure HTTPS, backups, atualizações e a política de retenção de e-mail no ambiente de produção.
- Execute verificações de acessibilidade, desempenho e SEO no domínio publicado. As metas de Lighthouse do briefing ainda não foram medidas.

## Estrutura

- `wp-content/themes/eso-arquitetura/`: apresentação e templates.
- `wp-content/plugins/eso-core/`: dados estruturados e endpoint do formulário.
- `docs/`: referências de conteúdo e licenças das imagens.

O core do WordPress, banco, uploads e segredos não são versionados. O site foi executado e verificado localmente em `http://localhost:8080`; esse endereço só funciona nesta máquina. Ainda não há link público nem capturas da interface versionadas. A instalação local de teste usa o usuário `eso-admin` e guarda a senha gerada em `.env` (arquivo ignorado pelo Git).
