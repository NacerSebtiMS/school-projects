def t_color(G,L) :
    Color_Sommets = [0]*len(G) #On initialise la liste de retour
    Color_Sommets[0] = L[0] #On initialise la première case du graphe
    Sommets_Traites = []
    #Sommets_Colores = [0]
    forbiden_color = []
    file_traitement = [0] #Nous pemettra de traiter les 
    for i in range(len(G)) :
        forbiden_color += [ [] ] # liste des couleurs interdites pour un sommet
    k=0
    print("Début du programme")
    while(len(Sommets_Traites) != len(G)-1): # On parcours le graphe jusqu'à ce que tout les sommets soit traités
        #print("Iteration",k+1)
        #print("Couleur des sommets :",Color_Sommets)
        i = file_traitement[k]
        for j in range( len(G[i] ) ): #On parcours les noeuds liés au noeud coloré et on rempli la liste des couleurs interdites des noeuds
            forbiden_color[ (G[i][j]) ] += [Color_Sommets[i]]
            if(G[i][j] not in file_traitement) : #Si l'element n'est pas dans la file de traitement on l'y ajoute
                file_traitement += [G[i][j]]
        #print("Forbidens : ",forbiden_color)
        #print("file_traitement :",file_traitement)
        Color_Sommets[ file_traitement[k+1] ] = L[ MNotInL( L , forbiden_color[ file_traitement[k+1] ] ) ]
        """
        sommet_interessent = G[i][ MNotInL(G[i], Sommets_Colores)]
        Color_Sommets[ sommet_interessent ] = L[ MNotInL( L , forbiden_color[sommet_interessent] ) ]
        Sommets_Colores += [ sommet_interessent ]
        """
        Sommets_Traites += [i]
        k += 1
        
    return Color_Sommets
            
def MNotInL(L, M) : #Retourne l'indice du premier élément de L qui n'est pas dans M
    for i in range(len(L)):
        if  L[i] not in M :
            return i
    print("Erreur")
            