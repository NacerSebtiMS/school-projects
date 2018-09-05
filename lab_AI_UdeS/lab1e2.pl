un_sur_deux([]).
un_sur_deux([_]).
un_sur_deux([_,Y|Z]) :- write(Y), un_sur_deux(Z).
