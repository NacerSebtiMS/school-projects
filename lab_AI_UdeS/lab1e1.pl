repas(H,P,D) :- ho(H,_), p(P,_), d(D,_).

repasLeger(H,P,D) :- ho(H,A), p(P,B), d(D,C), A+B+C<10.



%Donnees
%
ho(salade,1).
ho(pate,6).

p(sole,2).
p(thon,4).
p(porc,7).
p(boeuf,3).

d(glace,5).
d(fruit,1).
