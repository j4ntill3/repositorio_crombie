import { Main } from "../../shared/Main";
import { SectionCards } from "../../shared/Sections/SectionCards";
import { SectionInfo } from "../../shared/Sections/SectionInfo";
import { SectionTitle } from "../../shared/Sections/SectionTitle";
import Card from "../../shared/Card";

function AboutUs() {
  const teamMembers = [
    {
      name: "Jonny Knoxville",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/jonny-knoville.webp",
    },
    {
      name: "Bam Marguera",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/bam-margera.webp",
    },
    {
      name: "Chris Pontius",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/chris-pontius.jpg",
    },
    {
      name: "Dave England",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/dave_england.jpg",
    },
    {
      name: "Stevo O",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/steve-o.jpg",
    },
    {
      name: "Ryan Dunn (RIP)",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/ryan-dunn.jpg",
    },
    {
      name: "Ehren Mcghehey",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/ehren-mcghehey.jpg",
    },
    {
      name: "Preston Lacy",
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/preston-lacy.jpg",
    },
    {
      name: 'Jason "Wee Man" Acuña',
      img: "https://jackass-web-img.s3.us-east-2.amazonaws.com/weman.jpg",
    },
  ];

  return (
    <Main>
      <SectionInfo>
        <SectionTitle>
          <span>
            <strong>About Us</strong>
          </span>
        </SectionTitle>
        <p>
          Jackass is an American reality comedy TV series created by Jeff
          Tremaine, Spike Jonze, and Johnny Knoxville. It originally aired as
          three short seasons on MTV between October 2000 and August 2001, with
          reruns extending into 2002. The show featured a cast of nine friends
          carrying out stunts and pranks on each other and the public.
          <br />
          <br />
          Jackass was controversial due to its perceived indecency and potential
          encouragement of dangerous behavior. The show placed 68th on
          Entertainment Weekly's "New TV classNameics" list, and is a
          significant part of 2000s American popular culture.
          <br />
          <br />
        </p>
      </SectionInfo>

      <SectionTitle>
        <span>
          <strong>Team Jackass</strong>
        </span>
      </SectionTitle>

      <SectionCards>
        {teamMembers.map((member, index) => (
          <Card key={index} img={member.img} name={member.name} />
        ))}
      </SectionCards>
    </Main>
  );
}

export default AboutUs;
