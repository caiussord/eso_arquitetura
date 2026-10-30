# ESO Arquitetura

Site institucional demonstrativo para um escritório **fictício** de arquitetura. Os três projetos são estudos conceituais; as fotografias são referências licenciadas e não representam obras executadas pela ESO.

![Capa fotográfica de referência do projeto ESO](wp-content/themes/eso-arquitetura/assets/images/casa-horizonte.jpg)

## O que foi implementado

- Tema WordPress próprio em PHP, HTML, CSS e JavaScript, com home editorial e páginas Sobre, Serviços, Projetos, Contato, Privacidade e 404.
- Plugin `eso-core` com tipos de publicação para projetos, serviços e áreas de atuação. A ativação cria conteúdo demonstrativo editável pelo painel.
- Três cases fictícios identificados, metadados editáveis e imagem destacada opcional. Sem imagem destacada, o tema usa uma fotografia licenciada local.
- Formulário com validação no navegador e servidor, nonce, campo antispam, limite de frequência e envio via `wp_mail`.
- Navegação mobile, accordion com HTML nativo, foco visível, metadados básicos e suporte a movimento reduzido.

## Executar no Local (recomendado)

1. No aplicativo **Local**, clique em **Create a new site**. Nomeie o site `eso-arquitetura`, escolha **Preferred** e crie o usuário administrador do WordPress.
2. Abra **Go to site folder** no Local. Dentro de `app/public/wp-content/`, copie a pasta `wp-content/themes/eso-arquitetura` deste repositório para `themes/` e a pasta `wp-content/plugins/eso-core` para `plugins/`.
3. Clique em **WP Admin** no Local. Ative o tema **ESO Arquitetura** em **Aparência → Temas** e o plugin **ESO Core** em **Plugins**. A ativação do plugin cria a página inicial, três projetos, quatro serviços e três áreas de atuação.
4. Em **Configurações → Links permanentes**, escolha **Nome do post** e salve. Use **Open site** no Local para revisar o resultado.

Para verificar mensagens de teste, abra **Tools → Mailpit → Open Mailpit** no Local. A [documentação do Local](https://localwp.com/help-docs/local-features/mailpit/) confirma que o Mailpit captura as mensagens enviadas por `wp_mail()` neste ambiente. Em produção, configure um provedor SMTP transacional real.

O código do tema e do plugin fica neste repositório. Se você alterar arquivos aqui depois de copiá-los para o Local, copie-os novamente para a instalação ou use uma ligação de diretório entre as duas pastas.

### Ambiente Docker anterior (opcional)

O `compose.yaml` preserva o ambiente usado para a primeira verificação. Para iniciá-lo, copie `.env.example` para `.env`, troque as senhas e execute `docker compose up -d`. Ele serve em `http://localhost:8080` e usa Mailpit em `http://localhost:8025`. O Local é o fluxo recomendado para continuar o projeto.

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

O core do WordPress, banco, uploads e segredos não são versionados. A primeira verificação foi feita no ambiente Docker local; o site ainda precisa ser criado e conferido no Local. Ainda não há link público nem capturas da interface versionadas. A instalação Docker de teste usa o usuário `eso-admin` e guarda a senha gerada em `.env` (arquivo ignorado pelo Git).
