import styled from "styled-components";
import { ReactNode } from "react";

const SectionFormStyles = styled.section`
  text:align: center;  
  width: 95%;
  padding-left: 1.5rem;
  padding-right: 1.5rem;
`;

interface SectionFormProps {
  children: ReactNode;
}

function SectionForm({ children }: SectionFormProps) {
  return <SectionFormStyles>{children}</SectionFormStyles>;
}

export default SectionForm;
