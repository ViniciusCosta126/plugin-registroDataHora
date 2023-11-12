# Registro de data e hora - Plugin


## Como utilizar

### Adicionando direto no editor de texto do wordpress(Gutemberg)

Para adicionar o shortcode direto pelo do wordpress, basta o usuario adicionar o seguinte codigo dentro do editor
 - o parametro 'texto' é opcional poderia ser escolhido qual texto sera adicionado dentro do botão. Por default este texto é "Registrar data e hora no banco de dados"

```bash
    [registrarHorario texto='Registrar']
```

### Adicionando o shortcode dentro de algum arquivo do tema wordpress

Para adicionar o botão direto dentro do tema, voce pode usar o seguinte shortcode

```bash
    echo do_shortcode('[registrarHorario texto='Registrar']');
```
ou

```bash
    <?= do_shortcode('[registrarHorario texto='Registrar']') ?>
```
