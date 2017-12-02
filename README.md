# unisl-ia-trabalho
Heurística do Vizinho aplicado a Carteira de Investimentos

Um clube de investimentos está avaliando a sua carteira de ações. O clube escolheu 10 possíveis ações para investir. 
A política do clube é investir em 5 das 10 ações, sendo o investimento nessas 5 ações de 30%, 25%, 20%, 15% e 10%. 
Para escolher as 5 ações e a porcentagem de aplicação em cada ação, o clube utiliza a soma dos retornos mensagens dos últimos 12 meses.
O cálculo do retorno de cada mês é realizado como: Soma(RetornoAção_X * PorcentagemAção_X), onde X são as 10 possíveis ações escolhidas para investir. No quadro a seguir observa-se os cálculos, sendo a carteira escolhida: 30% na ação A; 25% na ação B; 20% na ação C; 15% na ação D e 10% na ação E.

TABELA

Utilize a heurística do vizinho para encontrar uma carteira de aplicação com o maior retorno anual.
a.	Seja a carteira inicial: 30% na ação A; 25% na ação B; 20% na ação C; 15% na ação D e 10% na ação E;
b.	Seja a carteira inicial aleatória, isto é sortear o 30% entre as ações A até J, 25% entre as ações restantes e assim sucessivamente. Realizar 10 buscas aleatórias.
c.	Apresentar o relatório das 11 buscas realizadas contendo: a carteira de ações e o valor do retorno atual de cada busca. Deverá ser apresentado em sala de aula o sistema rodando e o código fonte do sistema.
Observação
1.	Considerar o vizinho de uma solução, a troca do valor da aplicação de uma ação por outra ação (cada solução terá 35 vizinhos);
2.	Por exemplo do retorno da carteira inicial é:
Soma(RetornoMensal_AcaoA) * 0,3 + Soma(RetornoMensal_AcaoB) * 0,25 + ..... Soma(RetonoMensal_AcaoJ)*0;

