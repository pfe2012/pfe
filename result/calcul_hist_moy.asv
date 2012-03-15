 A=load('descripteur_Coil100Databases.txt');
 hist=A(:,1:192); % que les histogrammes
 ART=A(:,193:227); % que ART
 hist_nul(72)=0;
 for j=1:100
   moy_hist(j,:)=zeros(1,192); 
    for i=1:72
        moy_hist(j,:)=moy_hist(j,:)+hist(72*(j-1)+i,:);
     A=1;
    end
 end
B=0
B= B+moy_hist(1,:);
B= B+moy_hist(4,:);
B= B+moy_hist(27,:);
B= B+moy_hist(30,:);


