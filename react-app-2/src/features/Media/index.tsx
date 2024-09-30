import { Main } from "../../shared/Main";
import { SectionCards } from "../../shared/Sections/SectionCards";
import { SectionTitle } from "../../shared/Sections/SectionTitle";
import { SectionInfo } from "../../shared/Sections/SectionInfo";
import Card from "../../shared/Card";

function Media() {
  const movies = [
    {
      title: "Jackass The Movie",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/movie-jackass-1.jpg",
    },
    {
      title: "Jackass Number Two",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/jackass-number-two.jpg",
    },
    {
      title: "Jackass 3D",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/jackass-3d.jpg",
    },
    {
      title: "Jackass Forever",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/jackass-forever.jpg",
    },
  ];

  const seasons = [
    {
      title: "Season 1",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/jackass-vol-1.jpg",
    },
    {
      title: "Season 2",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/jackass-vol-2.jpg",
    },
    {
      title: "Season 3",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/jackass-vol-3.jpg",
    },
  ];

  return (
    <Main>
      <SectionTitle>
        <span>
          <strong>Movies</strong>
        </span>
      </SectionTitle>
      <SectionInfo>
        <SectionCards>
          {movies.map((movie, index) => (
            <Card key={index} img={movie.img} name={movie.title} />
          ))}
        </SectionCards>
      </SectionInfo>

      <SectionInfo>
        <SectionTitle>
          <span>
            <strong>Season</strong>
          </span>
        </SectionTitle>

        <SectionCards>
          {seasons.map((season, index) => (
            <Card key={index} img={season.img} name={season.title} />
          ))}
        </SectionCards>
      </SectionInfo>
    </Main>
  );
}

export default Media;
