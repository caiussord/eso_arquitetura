# ESO Arquitetura

Site institucional em WordPress para a ESO Arquitetura. Desenvolvi um tema próprio para a interface e um plugin para organizar projetos, serviços, áreas de atuação e o formulário de contato. O site já funciona no Local e pode ser editado pelo painel do WordPress.

![Fotografia de referência usada na página inicial](wp-content/themes/eso-arquitetura/assets/images/casa-horizonte.jpg)

## O projeto

A proposta visual usa fotografia, tipografia e uma grade editorial para apresentar o escritório sem depender de um tema pronto. A home reúne os projetos, as áreas de atuação e um resumo do processo de trabalho. Há também páginas de Sobre, Serviços, Contato, Política de Privacidade e uma página para cada projeto.

Os sete projetos do portfólio são estudos conceituais. As fotos servem como referência visual e não representam obras executadas pela ESO. Os créditos e as fontes estão em [docs/imagens.md](docs/imagens.md).

## Rodar localmente

1. Crie um site chamado `eso-arquitetura` no [Local](https://localwp.com/) e conclua a instalação do WordPress.
2. Copie `wp-content/themes/eso-arquitetura` deste repositório para a pasta `app/public/wp-content/themes/` do site no Local. Faça o mesmo com `wp-content/plugins/eso-core`, copiando para `app/public/wp-content/plugins/`.
3. No painel do WordPress, ative o tema **ESO Arquitetura** e o plugin **ESO Core**. O plugin cria as páginas e o conteúdo inicial, incluindo os sete projetos.
4. Em **Configurações → Links permanentes**, selecione **Nome do post** e salve.

O banco de dados, os uploads e o próprio WordPress ficam na instalação do Local; este repositório guarda o tema, o plugin e a documentação. O endereço `eso-arquitetura.local` funciona na máquina em que o site foi criado e enquanto estiver iniciado no Local.

## Conteúdo e contato

Projetos, serviços e áreas de atuação podem ser editados no painel. Cada projeto aceita imagem destacada, galeria e dados como tipo, localização, ano e área. Se não houver imagem destacada, o tema usa uma das fotos incluídas no repositório. Os textos principais das páginas fixas estão nos templates PHP.

O formulário valida os dados no navegador e no servidor, limita envios repetidos e usa `wp_mail`. No Local, os e-mails de teste aparecem no **Mailpit**. Antes de publicar o site, configure a entrega de e-mails, informe os contatos reais em **Aparência → Personalizar → ESO · Contato** e revise a Política de Privacidade para o uso pretendido.

## Código

- `wp-content/themes/eso-arquitetura/` — templates, estilos, scripts e imagens.
- `wp-content/plugins/eso-core/` — tipos de conteúdo, dados iniciais e processamento do formulário.
- `docs/` — referências visuais e créditos das fotografias.

O projeto usa PHP, CSS e JavaScript, sem page builder. A formatação dos arquivos PHP segue o padrão de código do WordPress; CSS e JavaScript seguem Prettier.
