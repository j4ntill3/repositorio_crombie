import type { NextApiRequest, NextApiResponse } from "next";
import nodemailer from "nodemailer";
import pool from "../api/db";

export default async function handler(
  req: NextApiRequest,
  res: NextApiResponse
) {
  const { nombre, email, mensaje } = req.body;

  try {
    const client = await pool.connect();
    const queryText =
      "INSERT INTO subscriptors(nombre, email, mensaje) VALUES($1, $2, $3) RETURNING *";
    const values = [nombre, email, mensaje];
    await client.query(queryText, values);
    client.release();

    const transporter = nodemailer.createTransport({
      service: "gmail",
      auth: {
        user: "joseantille@gmail.com",
        pass: "gyoa onzl bxxi puia",
      },
      tls: {
        rejectUnauthorized: false,
      },
    });

    const mailOptions = {
      from: "joseantille@gmail.com",
      to: email,
      subject: "Subscription Successful",
      text: `Hello ${nombre}, you have successfully subscribed!`,
    };

    await transporter.sendMail(mailOptions);
    res.status(200).json({ message: "Subscription successful" });
  } catch (error) {
    console.error("Error saving data or sending email:", error);
    res.status(500).json({ message: "Error subscribing" });
  }
}
