    #include <iostream>

    using namespace std;

    int Krit;
    int Alt;

    string bORc[100];
    float minormax[100];
    float minimal = INT_MAX;
    float maximal = INT_MIN;
    float total[100];

    float arr1[100][100];
    float arr2[100][100];
    float arr3[100];
    float arr4[100];
    float arr5[100][100];
    float arr6[100];
    float arr7[100][100];
    float arr8[100][100];
    float arr9[100];

    float t = 0;
    float CI;

    int main(){
        cin >> Krit;

        for (int i=0; i < Krit; i++){
            cin >> bORc[i];
        }


        for (int i=0; i < Krit; i++){
            for (int j=0; j < Krit; j++){
                cin >> arr1[i][j];
            }
        }

        for (int i=0; i < Krit; i++){
            float jumlah = 0;
            for (int j=0; j < Krit; j++){
                jumlah = jumlah + arr1[j][i];
            }
            for (int j=0; j < Krit; j++){
                arr2[j][i] = arr1[j][i]/jumlah;
            }
        }

        for (int i=0; i < Krit; i++){
            float jumlah = 0;
            for (int j=0; j < Krit; j++){
                jumlah = jumlah + arr2[i][j];
            }
            arr3[i] = jumlah/Krit;
        }

        for (int i=0; i < Krit; i++){
            float jumlah = 0;
            for (int j=0; j < Krit; j++){
                jumlah = jumlah + arr1[i][j] * arr3[j];
            }
            arr4[i] = jumlah;
        }

        for (int i=0; i < Krit; i++){
            t = t + arr4[i];
        }

        CI = (t - Krit)/(Krit - 1);

        cin >> Alt;

        for (int i=0; i < Alt; i++){
            for (int j=0; j < Krit; j++){
                cin >> arr5[i][j];
            }
        }

        for (int i = 0; i < Krit; i++){
            if (bORc[i] == "c"){
                minormax[i] = minimal;
            } else if (bORc[i] == "b"){
                minormax[i] = maximal;
            }
            for (int j = 0; j < Alt; j++){
                if(bORc[i] == "c" && minormax[i] > arr5[j][i]){
                    minormax[i] = arr5[j][i];
                } else if(bORc[i] == "b" && minormax[i] < arr5[j][i]){
                    minormax[i] = arr5[j][i];
                }
            }
        }

        for (int i = 0; i < Alt; i++){
            for (int j = 0; j < Krit; j++){
                if (bORc[j] == "c"){
                    arr7[i][j] = minormax[j]/arr5[i][j];
                } else if (bORc[j] == "b"){
                    arr7[i][j] = arr5[i][j]/minormax[j];
                }
            }
        }

        for (int i = 0; i < Krit; i++){
            float jumlah = 0;
            for(int j = 0; j < Alt; j++){
                jumlah += arr7[j][i];
            }
            total[i] = jumlah;
            for (int j = 0; j < Alt; j++){
                for (int k = 0; k < Krit; k++){
                    arr8[j][k] = arr7[j][k]/total[k];
                }
            }
        }

        for (int i = 0; i < Alt; i++){
            float jumlah = 0;
            for (int j = 0; j < Krit; j++){
                jumlah += arr8[i][j] * arr3[j];
            }
            arr9[i] = jumlah;
            jumlah = 0;
            cout << arr9[i] << " " ;
        }

    }