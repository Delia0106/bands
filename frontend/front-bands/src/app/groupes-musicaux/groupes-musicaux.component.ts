import { Component, EventEmitter, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { GroupeMusical } from '../groupeMusical';

@Component({
  selector: 'app-groupes-musicaux',
  templateUrl: './groupes-musicaux.component.html',
  styleUrls: ['./groupes-musicaux.component.scss'],
})
export class GroupesMusicauxComponent implements OnInit {
  public groupesMusicaux: any[] | undefined;
  public nouveauGroupeMusical: any = {};

  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    this.chargementInformations();
  }

  public chargementInformations(): void {
    this.apiService.getGroupesMusicaux().subscribe((data: GroupeMusical[]) => {
      this.groupesMusicaux = data;
    });
  }

  public supprimerLigne(id: number): void {
    this.apiService.supprimerGroupeMusical(id).subscribe(
      (response) => {
        console.log('succes', response);
        this.actualiserListeAprèsSuppression(id);
      },
      (error) => {
        console.error('err:', error);
      }
    );
  }

  public actualiserListeAprèsSuppression(id: number): void {
    if (this.groupesMusicaux) {
      this.groupesMusicaux = this.groupesMusicaux.filter(
        (groupe) => groupe.id !== id
      );
    }
  }

  public actualiserGroupeMusical(id: number, groupe: any): void {
    this.apiService.actualiserGroupeMusical(id, groupe).subscribe(
      (response) => {
        console.log('succes:', response);
        this.chargementInformations();
      },
      (error) => {
        console.error('err:', error);
      }
    );
  }
}
